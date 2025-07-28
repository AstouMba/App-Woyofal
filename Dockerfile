# Utilise l'image PHP-FPM
FROM php:8.3-fpm

# Installer les dépendances système + extensions PHP
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    curl \
    git \
    && docker-php-ext-install pdo pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

#  Installer Composer (copie depuis l'image officielle)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application
COPY . .

# Configurer les permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"] 