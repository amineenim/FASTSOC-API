# Utiliser l'image officielle PHP avec les extensions nécessaires
FROM php:8.1-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www

# Copier les fichiers du projet Laravel
COPY . /var/www

# Donner les permissions
RUN chown -R www-data:www-data /var/www

# Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

# Commande par défaut
CMD ["php-fpm"]
