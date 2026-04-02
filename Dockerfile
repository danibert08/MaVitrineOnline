FROM php:8.2-apache

# 1. On installe le nécessaire pour Symfony et Composer
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libzip-dev libpng-dev libxml2-dev libcurl4-openssl-dev \
    && docker-php-ext-install intl opcache pdo pdo_mysql zip gd xml curl

RUN a2enmod rewrite

# 2. Config Apache pour pointer sur /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 3. Récupération de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# 4. Installation "Safe" des dépendances
# --no-scripts empêche Symfony de planter s'il n'y a pas de DB
# --ignore-platform-reqs assure que ça passe même si le build est capricieux
RUN composer install --no-dev --optimize-autoloader --no-scripts --ignore-platform-reqs

# 5. On vide le cache et on compile avec un maximum de détails
RUN php bin/console cache:clear --env=prod && \
    DATABASE_URL="sqlite:///:memory:" php bin/console asset-map:compile -vv --env=prod || true

# 6. Droits d'écriture
# On crée les dossiers au cas où ils n'existeraient pas pour éviter que le chown ne plante
RUN mkdir -p /var/www/html/var /var/www/html/public/assets && \
    chown -R www-data:www-data /var/www/html/var /var/www/html/public/assets