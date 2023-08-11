FROM php:8.1.13-fpm
RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y \
        openssh-client \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libcurl4-openssl-dev \
        libldap2-dev \
        libicu-dev \
        libc-client-dev \
        libkrb5-dev \
        libonig-dev \
        libmagickwand-dev --no-install-recommends \
        curl \
        libtidy* \
        libzip-dev \
        mariadb-client \
        gnupg \
        git \
        rsync \
        unzip \
    && apt-get clean \
    && rm -r /var/lib/apt/lists/*

RUN docker-php-ext-install \
        pdo_mysql \
        exif \
        tidy \
        zip \
        bcmath \
        opcache \
		soap \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu \
    && docker-php-ext-install ldap \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap

RUN echo "memory_limit=-1" > $PHP_INI_DIR/conf.d/memory-limit.ini \
    && echo "date.timezone=Europe/Warsaw" > $PHP_INI_DIR/conf.d/date_timezone.ini \
    && echo "upload_max_filesize=1024M" > $PHP_INI_DIR/conf.d/upload_max_filesize.ini \
    && echo "post_max_size=1024M" > $PHP_INI_DIR/conf.d/post_max_size.ini

VOLUME /root/composer

ENV COMPOSER_HOME /root/composer

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer selfupdate
    
WORKDIR /tmp

# Run phpunit installation
RUN composer require "phpunit/phpunit=9.*" --prefer-source --no-interaction \
    && ln -s /tmp/vendor/bin/phpunit /usr/local/bin/phpunit

# Run codesniffer installation
RUN composer require "squizlabs/php_codesniffer=*" --prefer-source --no-interaction \
    && ln -s /tmp/vendor/bin/phpcs /usr/local/bin/phpcs

# NVM & NodeJS & Yarn
ENV NODE_VERSION 16.7.0

ENV NVM_DIR /root/.nvm
ENV PATH $NVM_DIR/versions/node/v$NODE_VERSION/bin:$PATH

RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.38.0/install.sh | bash \
    && . $NVM_DIR/nvm.sh \
    && nvm install $NODE_VERSION \
    && npm install -g yarn \
    && nvm install 10.24.1 \
    && npm install -g yarn \
    && nvm alias default $NODE_VERSION \
    && nvm use default

WORKDIR /home/www

RUN php --version \
    && composer --version \
    && phpunit --version \
    && phpcs --version \
    && node --version \
    && yarn --version
