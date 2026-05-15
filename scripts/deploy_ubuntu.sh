#!/bin/bash

# ==============================================================================
# TitanCompress - Production Deployment Script
# OS: Ubuntu 24.04 LTS
# Stack: Nginx, PHP 8.3, MySQL 8
# ==============================================================================

set -e # Exit on error

echo "🚀 Initiating TitanCompress Deployment..."

# 1. Update OS & Install Dependencies
echo "📦 Installing system dependencies..."
sudo apt update && sudo apt upgrade -y
sudo apt install -y software-properties-common curl zip unzip git nginx mysql-server supervisor

# 2. Add PHP 8.3 Repository
echo "🐘 Installing PHP 8.3..."
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install -y php8.3-fpm php8.3-cli php8.3-mysql php8.3-curl \
    php8.3-mbstring php8.3-xml php8.3-bcmath php8.3-zip php8.3-gd php8.3-intl

# 3. Install Composer
echo "🎼 Installing Composer..."
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# 4. Install Node.js & NPM
echo "🟢 Installing Node.js..."
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs

# 5. Set up Project Directory
PROJECT_DIR="/var/www/titancompress"
echo "📂 Setting up project directory at $PROJECT_DIR..."
sudo mkdir -p $PROJECT_DIR
sudo chown -R $USER:$USER $PROJECT_DIR

# 6. Clone/Copy Code (Assuming code is already here for this script)
# git clone git@github.com:your-org/titancompress.git $PROJECT_DIR
cd $PROJECT_DIR

# 7. Install Dependencies
echo "⚙️ Installing project dependencies..."
composer install --optimize-autoloader --no-dev
npm ci
npm run build

# 8. Setup Permissions
echo "🔒 Securing permissions..."
sudo chown -R www-data:www-data $PROJECT_DIR/storage $PROJECT_DIR/bootstrap/cache
sudo chmod -R 775 $PROJECT_DIR/storage $PROJECT_DIR/bootstrap/cache

# 9. Nginx Configuration
echo "🌐 Configuring Nginx..."
sudo cp scripts/nginx.conf /etc/nginx/sites-available/titancompress
sudo ln -sf /etc/nginx/sites-available/titancompress /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx

# 10. Supervisor Configuration (Queue workers)
echo "👷 Configuring Supervisor..."
sudo cp scripts/supervisor.conf /etc/supervisor/conf.d/titancompress.conf
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start titancompress-worker:*

# 11. Laravel Optimization
echo "⚡ Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

echo "✅ Deployment Successful! TitanCompress is live."
