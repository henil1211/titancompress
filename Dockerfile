FROM php:8.3-cli

# Install dependencies
RUN apt-get update -y && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip mbstring

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app

# Install PHP and Node dependencies, then build Vite assets
RUN composer install --optimize-autoloader
RUN npm install
RUN npm run build

# Set permissions
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Start the application
CMD touch /app/database/database.sqlite && php artisan migrate:fresh --seed --force && php artisan serve --host=0.0.0.0 --port=$PORT
