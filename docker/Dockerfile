# SET AND DOWNLOAD BASE IMAGE WITH APACHE AND PHP AS SPECIFIED VERSION #
FROM php:8.1-apache as dev

# SET ENVIROMENTS #
ENV APACHE_VAR_WWW /var/www
ENV APACHE_DOCUMENT_ROOT $APACHE_VAR_WWW/justcode
ENV DEBIAN_DEPS \
    chromium \
    chromium-driver \
    curl \
    gdb \

    libicu-dev \
    libpq-dev \
    git \
    libzip-dev \
    librabbitmq-dev \
    zip

# INSTALL DEBIAN DEPS #
RUN rm -f /etc/localtime \
    && ln -s /usr/share/zoneinfo/Europe/Warsaw /etc/localtime \
    && mkdir -p /usr/share/man/man1 \
    && apt-get update \
    && apt-get --no-install-recommends install -y $DEBIAN_DEPS

# SETUP PHP EXTENSIONS #
RUN set -ex \
	&& docker-php-source extract; \
	{ \
		echo '# https://github.com/docker-library/php/issues/103#issuecomment-271413933'; \
		echo 'AC_DEFUN([PHP_ALWAYS_SHARED],[])dnl'; \
		echo; \
		cat /usr/src/php/ext/odbc/config.m4; \
	} > temp.m4 \
	&& mv temp.m4 /usr/src/php/ext/odbc/config.m4 \
	&& docker-php-source extract \
    && docker-php-ext-configure intl --enable-intl && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-configure opcache && docker-php-ext-install -j$(nproc) opcache \
    && docker-php-ext-configure pdo_pgsql && docker-php-ext-install -j$(nproc) pdo_pgsql \
    && docker-php-ext-configure zip && docker-php-ext-install -j$(nproc) zip \
    && pecl install apcu && docker-php-ext-enable apcu \
    && pecl install amqp && docker-php-ext-enable amqp \
    && pecl install igbinary && docker-php-ext-enable igbinary \
    && pecl install xdebug && docker-php-ext-enable xdebug \
    && curl -s https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# SET CONFIGURATION OF PHP EXTENSIONS #
COPY docker/php/docker-php-ext-apcu.ini /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini
COPY docker/php/docker-php-ext-opcache.ini /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini
COPY docker/php/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY docker/php/date.ini /usr/local/etc/php/conf.d/date.ini
COPY docker/php/intl.ini /usr/local/etc/php/conf.d/intl.ini
COPY docker/php/php.ini /usr/local/etc/php/php.ini

# SETUP APACHE #
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && a2enmod proxy_fcgi ssl rewrite proxy proxy_balancer proxy_http proxy_ajp \
    && rm -f /run/apache2/apache2.pid \
    && rm -r /etc/apache2/sites-enabled/* \
    && rm -r /etc/apache2/sites-available/* \
    && rm /var/log/apache2/access.log \
    && rm /var/log/apache2/error.log \
    && rm /var/log/apache2/other_vhosts_access.log \
    && touch /var/log/apache2/access.log \
    && touch /var/log/apache2/error.log \
    && touch /var/log/apache2/other_vhosts_access.log \
    && chown www-data:www-data /var/log/apache2/access.log \
    && chown www-data:www-data /var/log/apache2/error.log \
    && chown www-data:www-data /var/log/apache2/other_vhosts_access.log \
    && chmod 777 /var/log/apache2/access.log \
    && chmod 777 /var/log/apache2/error.log \
    && chmod 777 /var/log/apache2/other_vhosts_access.log
COPY docker/apache/vhost.conf /etc/apache2/sites-enabled/vhost.conf
COPY docker/apache/ports.conf /etc/apache2/ports.conf
COPY docker/apache/apache2.conf /etc/apache2/apache2.conf

# CLEAR CACHE DUE TO SAVE SPACE FOR DOCKER IMAGE #
RUN apt-get auto-remove -y \
    && apt-get clean \
    && apt-get autoclean \
    && docker-php-source delete \
    && rm -rf /var/lib/apt/lists/*

# EXPOSE PORTS #
EXPOSE 80

# CHANGE CURRENT WORKDIR #
WORKDIR $APACHE_DOCUMENT_ROOT

FROM dev as install-backend-dependencies

COPY composer.json composer.lock ./

RUN composer install --no-dev --optimize-autoloader --apcu-autoloader --no-interaction --no-progress --no-scripts

FROM node:14 as install-frontend-dependencies

WORKDIR /var/www/justcode

COPY package*.json ./

COPY --from=install-backend-dependencies /var/www/justcode/vendor ./vendor

RUN npm ci


FROM node:14 as build-assets

WORKDIR /app

COPY package*.json ./
COPY webpack.config.js ./

COPY --from=install-backend-dependencies /var/www/justcode/vendor ./vendor
COPY --from=install-frontend-dependencies /var/www/justcode/node_modules ./node_modules
COPY src ./src
COPY assets ./assets
RUN echo 'NODE_ENV=production' >> .env

RUN npm run build


FROM dev as prod

WORKDIR /var/www/justcode

COPY . ./

COPY --from=install-backend-dependencies /var/www/justcode/vendor ./vendor
COPY --from=build-assets /app/public/build ./public/build

RUN mkdir -p var/cache var/log var/cache/prod
RUN chmod -R  777 var

CMD php ./bin/console assets:install public && php ./bin/console --no-interaction doctrine:migrations:migrate && apache2-foreground

FROM prod as migrations

RUN apt-get update \
  && apt-get install -y postgresql-client \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

