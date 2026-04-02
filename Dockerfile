# Utilise PHP avec Apache pour simplifier la gestion du dossier public
FROM php:8.2-apache

# 1. Installation des dépendances système
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libzip-dev libpng-dev \
    && docker-php-ext-install intl opcache pdo pdo_mysql zip gd

# 2. Activation du module rewrite d'Apache (Crucial pour Symfony)
RUN a2enmod rewrite

# 3. Configuration du DocumentRoot d'Apache vers /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 5. Copie des fichiers du projet
COPY . .

# 6. Installation des dépendances PHP et compilation des assets
RUN composer install --no-dev --optimize-autoloader
RUN php bin/console asset-map:compile

# 7. Droits sur les dossiers pour Apache
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/public/assets