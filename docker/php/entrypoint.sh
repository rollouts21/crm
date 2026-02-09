#!/usr/bin/env sh
set -e

cd /var/www/html

# Clear cached config/routes to avoid stale values in dev
if [ "${CLEAR_CACHE_ON_BOOT:-1}" = "1" ]; then
  rm -f bootstrap/cache/config.php bootstrap/cache/routes-*.php || true
fi

# Composer deps
if [ ! -d "vendor" ]; then
  echo "[entrypoint] vendor/ not found -> composer install"
  composer install --no-interaction --prefer-dist
fi

# .env
if [ ! -f ".env" ] && [ -f ".env.example" ]; then
  echo "[entrypoint] .env not found -> copy from .env.example"
  cp .env.example .env
fi

# Wait DB (do not hard-fail so php-fpm still starts -> avoid 502)
echo "[entrypoint] waiting for database..."
php -r '
$host=getenv("DB_HOST") ?: "db";
$port=(int)(getenv("DB_PORT") ?: 5432);
$start=time();
while (true) {
  $fp=@fsockopen($host,$port,$errno,$errstr,1);
  if ($fp) { fclose($fp); break; }
  if (time()-$start > 120) { fwrite(STDERR,"DB not ready, continuing\n"); exit(0); }
  usleep(200000);
}
'

# Start PHP-FPM early to avoid 502 while bootstrap tasks run
"$@" &
php_fpm_pid=$!

# Key generate if empty
if ! grep -q "^APP_KEY=base64:" .env 2>/dev/null; then
  echo "[entrypoint] generating APP_KEY"
  php artisan key:generate --force || true
fi

# Migrations (для локалки ок)
if [ "${RUN_MIGRATIONS:-1}" = "1" ]; then
  echo "[entrypoint] migrate"
  php artisan migrate --force || true
fi

# Cache (опционально, в локалке часто мешает запуску)
if [ "${RUN_OPTIMIZE:-0}" = "1" ]; then
  php artisan config:cache || true
  php artisan route:cache || true
  php artisan view:cache || true
fi

wait "$php_fpm_pid"
