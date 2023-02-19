FROM php:fpm

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    vim \
    git \
    wget \
    yui-compressor \
    poppler-utils libtidy-dev \
    icu-devtools libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install intl pdo pdo_mysql

RUN cd /usr/local/etc/php/conf.d/ && \
    echo 'memory_limit = 512M' >> /usr/local/etc/php/conf.d/docker-php-ram-limit.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ARG CODE_ENV
ARG VERSION=v16.14.0

RUN mkdir /build && apArch=$(arch); \
    case "$apArch" in \
    x86_64) export DISTRO='linux-x64' ;; \
    aarch64) export DISTRO='linux-arm64' ;;\
    esac;\
    cd /build && \
    wget https://nodejs.org/dist/v16.14.0/node-${VERSION}-${DISTRO}.tar.xz && \
    tar -xvf node-${VERSION}-${DISTRO}.tar.xz --strip-components=1 -C /usr/local

#
# local/test depdencies
#
RUN if [[ "$CODE_ENV" != "prod" ]]; then \
        apk add git \
        && apk add --no-cache --virtual .php-deps file re2c autoconf make zlib zlib-dev g++ curl \
        && pecl install xdebug \
        && docker-php-ext-enable xdebug \
        && apk del -f .php-deps; \
    fi

RUN docker-php-ext-install tidy && docker-php-ext-enable tidy

RUN docker-php-ext-install exif

RUN docker-php-ext-install zip

RUN apt-get clean && apt-get autoremove -y && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/src

ARG TMP=/var/www/html/tmp
ARG LOGS=/var/www/html/logs
ARG UPLOADS=/var/www/html/webroot/Uploads

#RUN mkdir ${TMP}
#RUN mkdir ${LOGS}
#RUN mkdir ${UPLOADS}
#RUN chown 1000:1000 ${TMP}
#RUN chown 1000:1000 ${LOGS}
#RUN chown 1000:1000 ${UPLOADS}
#RUN chmod -R 0777 ${UPLOADS}
