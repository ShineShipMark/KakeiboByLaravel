FROM php:8.4-fpm

# 必要な拡張
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev libonig-dev procps curl \
 && docker-php-ext-install pdo_mysql intl zip \
 && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get install -y nodejs

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ
WORKDIR /var/www/html

CMD ["php-fpm"]

# ホストのUID/GIDを受け取るための変数
ARG USER_ID=1000
ARG GROUP_ID=1000

# ユーザーの作成（名前は devuser としています）
RUN groupadd -g ${GROUP_ID} devgroup || true && \
    useradd -m -u ${USER_ID} -g ${GROUP_ID} devuser || true

# 作業ディレクトリの所有者を変更（必要に応じて）
# RUN chown -R devuser:devgroup /var/www/html

# デフォルトユーザーを root から devuser に切り替え
USER devuser
