sh
#!/bin/sh

set -e

echo "Running Laravel migrations..."

php artisan migrate --force

echo "Seeding specialties..."

php artisan db:seed --class=SpecialtySeeder --force

echo "Seeding production admin..."

php artisan db:seed --class=AdminSeeder --force

echo "Starting Apache..."

exec apache2-foreground

