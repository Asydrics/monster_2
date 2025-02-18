# Étape 1 : Utiliser une image PHP avec Apache
FROM php:8.2-apache

# Étape 2 : Installer les extensions et dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libzip-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Étape 3 : Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Étape 4 : Copier le projet Laravel
WORKDIR /var/www/html
COPY . /var/www/html

# Étape 5 : Donner les permissions nécessaires
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
RUN apt-get update && apt-get install -y libssl-dev


# Étape 6 : Activer le module Apache rewrite
RUN a2enmod rewrite

# Étape 7 : Exposer le port 80
EXPOSE 80

# Étape 8 : Lancer Apache
CMD ["apache2-foreground"]
