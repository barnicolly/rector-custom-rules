FROM dockerhub.ratnikovmikhail.ru/php:8.3.6-composer

ARG USER_NAME
ARG USER_ID
ARG USER_GROUP_NAME
ARG USER_GROUP_ID

RUN apk add --no-cache --virtual .build-deps  \
                libjpeg-turbo-dev \
                libpng-dev \
                libwebp-dev \
                freetype-dev \
    && apk add --no-cache libzip-dev zip poppler-utils antiword fcgi ffmpeg \
    && NPROC=$(getconf _NPROCESSORS_ONLN) \
    && docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype \
    && docker-php-ext-configure zip \
    && docker-php-ext-install -j${NPROC} \
        pcntl \
        gd \
        zip \
    && apk del -f .build-deps \
    && rm -rf /var/cache/apk/*

ENV LANG=ru_RU.UTF-8

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

WORKDIR /var/www/html

RUN addgroup --system --gid ${USER_GROUP_ID} ${USER_GROUP_NAME} \
    && adduser --system --uid ${USER_ID} --ingroup ${USER_GROUP_NAME} ${USER_NAME}

COPY docker/php/entrypoint.sh /var/www/entrypoint.sh
COPY docker/php/php-fpm.d/docker.conf /usr/local/etc/php-fpm.d/docker.conf

RUN ["chmod", "+x", "/var/www/entrypoint.sh"]

RUN chown -R ${USER_NAME}:${USER_NAME} /var/www/html
USER ${USER_NAME}
EXPOSE 9000

CMD ["/var/www/entrypoint.sh","php-fpm","-F"]