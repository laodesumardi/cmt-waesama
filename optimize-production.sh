#!/bin/bash

# Script Optimasi Production untuk Website Camat
# Jalankan script ini setelah deployment ke server production

echo "🚀 Memulai optimasi production untuk Website Camat..."

# 1. Install dependencies production
echo "📦 Installing production dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction

# 2. Build assets
echo "🎨 Building production assets..."
npm ci --only=production
npm run build

# 3. Clear semua cache
echo "🧹 Clearing all caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 4. Generate application key jika belum ada
if grep -q "APP_KEY=$" .env; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
fi

# 5. Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# 6. Create storage link
echo "🔗 Creating storage symbolic link..."
php artisan storage:link

# 7. Cache untuk production
echo "⚡ Caching for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 8. Optimize autoloader
echo "🔧 Optimizing autoloader..."
composer dump-autoload --optimize

# 9. Set proper permissions
echo "🔒 Setting proper permissions..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || echo "⚠️ Could not change ownership (run as root if needed)"

# 10. Restart queue workers jika ada
echo "🔄 Restarting queue workers..."
php artisan queue:restart

echo "✅ Optimasi production selesai!"
echo ""
echo "📋 Checklist selanjutnya:"
echo "   1. Pastikan file .env sudah dikonfigurasi dengan benar"
echo "   2. Pastikan SSL certificate sudah terpasang"
echo "   3. Setup cron job untuk Laravel scheduler"
echo "   4. Setup monitoring dan backup"
echo "   5. Test semua fitur aplikasi"
echo ""
echo "🌐 Website siap untuk production!"