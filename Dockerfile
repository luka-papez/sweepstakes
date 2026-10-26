FROM php:8.4-cli-alpine

# unzip/git let Composer download packages; pdo_sqlite & co ship with the base image.
RUN apk add --no-cache git unzip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# The container runs as your host user (see docker-compose.yml), who has no home directory inside it.
ENV HOME=/tmp \
    COMPOSER_HOME=/tmp/composer

WORKDIR /app

COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

EXPOSE 8000

ENTRYPOINT ["entrypoint"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
