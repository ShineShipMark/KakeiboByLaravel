FROM php:8.4-fpm

# 必要な拡張
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev libonig-dev procps \
    && docker-php-ext-install pdo_mysql intl zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ
WORKDIR /var/www/html

CMD ["php-fpm"]
