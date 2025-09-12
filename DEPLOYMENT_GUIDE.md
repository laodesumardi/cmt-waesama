# Panduan Deployment Website Camat

Panduan ini menjelaskan langkah-langkah untuk deploy aplikasi Website Camat ke server production.

## Persiapan Server

### 1. Persyaratan Server
- PHP 8.2 atau lebih tinggi
- MySQL 8.0 atau MariaDB 10.3+
- Nginx atau Apache
- Composer
- Node.js dan NPM
- Redis (opsional, untuk caching)
- SSL Certificate

### 2. Ekstensi PHP yang Diperlukan
```bash
sudo apt install php8.2-fpm php8.2-mysql php8.2-xml php8.2-gd php8.2-curl php8.2-mbstring php8.2-zip php8.2-bcmath php8.2-intl php8.2-redis
```

## Langkah Deployment

### 1. Upload Files
```bash
# Upload semua file kecuali:
# - .env (akan dibuat terpisah)
# - node_modules/
# - vendor/ (akan di-install ulang)
# - storage/logs/*
# - storage/framework/cache/*
# - storage/framework/sessions/*
# - storage/framework/views/*
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install --optimize-autoloader --no-dev

# Install Node.js dependencies
npm install

# Build assets untuk production
npm run build
```

### 3. Konfigurasi Environment
```bash
# Copy template production environment
cp .env.production .env

# Edit file .env dengan konfigurasi server Anda
nano .env

# Generate application key baru
php artisan key:generate
```

### 4. Setup Database
```bash
# Jalankan migrasi database
php artisan migrate --force

# Seed data awal (opsional)
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=AdminUserSeeder
php artisan db:seed --class=VillageInfoSeeder
```

### 5. Setup Storage
```bash
# Buat symbolic link untuk storage
php artisan storage:link

# Set permission yang benar
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### 6. Optimasi Production
```bash
# Cache konfigurasi
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

### 7. Setup Queue Worker (Opsional)
```bash
# Install supervisor
sudo apt install supervisor

# Buat konfigurasi worker
sudo nano /etc/supervisor/conf.d/website-camat-worker.conf
```

Isi file konfigurasi:
```ini
[program:website-camat-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/your/project/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/path/to/your/project/storage/logs/worker.log
stopwaitsecs=3600
```

```bash
# Reload supervisor
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start website-camat-worker:*
```

## Konfigurasi Web Server

### Nginx Configuration
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name your-domain.com www.your-domain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name your-domain.com www.your-domain.com;
    root /path/to/your/project/public;

    # SSL Configuration
    ssl_certificate /path/to/ssl/certificate.crt;
    ssl_certificate_key /path/to/ssl/private.key;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers ECDHE-RSA-AES256-GCM-SHA512:DHE-RSA-AES256-GCM-SHA512:ECDHE-RSA-AES256-GCM-SHA384:DHE-RSA-AES256-GCM-SHA384;
    ssl_prefer_server_ciphers off;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;
    add_header Content-Security-Policy "default-src 'self' http: https: data: blob: 'unsafe-inline'" always;

    index index.php;

    charset utf-8;

    # Handle Laravel routes
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Handle PHP files
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Deny access to hidden files
    location ~ /\. {
        deny all;
    }

    # Handle static files
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }

    # File upload size
    client_max_body_size 10M;
}
```

## Monitoring dan Maintenance

### 1. Setup Cron Jobs
```bash
# Edit crontab
crontab -e

# Tambahkan baris berikut:
* * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
```

### 2. Log Monitoring
```bash
# Monitor error logs
tail -f storage/logs/laravel.log

# Monitor nginx logs
tail -f /var/log/nginx/error.log
```

### 3. Backup Database
```bash
# Script backup harian
#!/bin/bash
DATE=$(date +"%Y%m%d_%H%M%S")
mysqldump -u username -p database_name > /backup/website_camat_$DATE.sql

# Hapus backup lama (lebih dari 30 hari)
find /backup -name "website_camat_*.sql" -mtime +30 -delete
```

## Troubleshooting

### Masalah Umum

1. **Gambar tidak muncul**
   - Pastikan symbolic link storage sudah dibuat
   - Periksa permission folder storage
   - Pastikan APP_URL sudah benar

2. **Error 500**
   - Periksa log di storage/logs/laravel.log
   - Pastikan semua permission sudah benar
   - Clear semua cache

3. **Database connection error**
   - Periksa konfigurasi database di .env
   - Pastikan database server berjalan
   - Test koneksi database

4. **Queue jobs tidak berjalan**
   - Periksa supervisor status
   - Restart queue worker
   - Periksa log worker

### Perintah Maintenance
```bash
# Clear semua cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Restart queue workers
php artisan queue:restart

# Check aplikasi status
php artisan about
```

## Keamanan

1. **Update rutin**
   - Update Laravel dan dependencies secara berkala
   - Monitor security advisories

2. **Backup**
   - Backup database harian
   - Backup files mingguan
   - Test restore procedure

3. **Monitoring**
   - Setup monitoring untuk uptime
   - Monitor disk space
   - Monitor memory usage

---

**Catatan**: Pastikan untuk mengganti semua placeholder (your-domain.com, /path/to/your/project, dll.) dengan nilai yang sesuai untuk server Anda.