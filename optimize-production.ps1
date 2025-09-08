# Script Optimasi Production untuk Website Camat (Windows PowerShell)
# Jalankan script ini setelah deployment ke server production Windows

Write-Host "🚀 Memulai optimasi production untuk Website Camat..." -ForegroundColor Green

try {
    # 1. Install dependencies production
    Write-Host "📦 Installing production dependencies..." -ForegroundColor Yellow
    composer install --optimize-autoloader --no-dev --no-interaction
    if ($LASTEXITCODE -ne 0) { throw "Composer install failed" }

    # 2. Build assets
    Write-Host "🎨 Building production assets..." -ForegroundColor Yellow
    npm ci --only=production
    if ($LASTEXITCODE -ne 0) { throw "NPM install failed" }
    
    npm run build
    if ($LASTEXITCODE -ne 0) { throw "NPM build failed" }

    # 3. Clear semua cache
    Write-Host "🧹 Clearing all caches..." -ForegroundColor Yellow
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    php artisan view:clear

    # 4. Generate application key jika belum ada
    $envContent = Get-Content .env -Raw
    if ($envContent -match "APP_KEY=\s*$") {
        Write-Host "🔑 Generating application key..." -ForegroundColor Yellow
        php artisan key:generate --force
    }

    # 5. Run database migrations
    Write-Host "🗄️ Running database migrations..." -ForegroundColor Yellow
    php artisan migrate --force
    if ($LASTEXITCODE -ne 0) { throw "Database migration failed" }

    # 6. Create storage link
    Write-Host "🔗 Creating storage symbolic link..." -ForegroundColor Yellow
    php artisan storage:link

    # 7. Cache untuk production
    Write-Host "⚡ Caching for production..." -ForegroundColor Yellow
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache

    # 8. Optimize autoloader
    Write-Host "🔧 Optimizing autoloader..." -ForegroundColor Yellow
    composer dump-autoload --optimize

    # 9. Set proper permissions (Windows)
    Write-Host "🔒 Setting proper permissions..." -ForegroundColor Yellow
    $storageDir = "storage"
    $cacheDir = "bootstrap\cache"
    
    if (Test-Path $storageDir) {
        icacls $storageDir /grant "IIS_IUSRS:(OI)(CI)F" /T 2>$null
        icacls $storageDir /grant "IUSR:(OI)(CI)F" /T 2>$null
    }
    
    if (Test-Path $cacheDir) {
        icacls $cacheDir /grant "IIS_IUSRS:(OI)(CI)F" /T 2>$null
        icacls $cacheDir /grant "IUSR:(OI)(CI)F" /T 2>$null
    }

    # 10. Restart queue workers jika ada
    Write-Host "🔄 Restarting queue workers..." -ForegroundColor Yellow
    php artisan queue:restart

    Write-Host "✅ Optimasi production selesai!" -ForegroundColor Green
    Write-Host ""
    Write-Host "📋 Checklist selanjutnya:" -ForegroundColor Cyan
    Write-Host "   1. Pastikan file .env sudah dikonfigurasi dengan benar" -ForegroundColor White
    Write-Host "   2. Pastikan SSL certificate sudah terpasang" -ForegroundColor White
    Write-Host "   3. Setup scheduled task untuk Laravel scheduler" -ForegroundColor White
    Write-Host "   4. Setup monitoring dan backup" -ForegroundColor White
    Write-Host "   5. Test semua fitur aplikasi" -ForegroundColor White
    Write-Host ""
    Write-Host "🌐 Website siap untuk production!" -ForegroundColor Green

} catch {
    Write-Host "❌ Error during optimization: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host "Please check the error and try again." -ForegroundColor Red
    exit 1
}