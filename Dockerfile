FROM composer:2.4.4 as vendor

RUN rm -rf /var/www && mkdir -p /var/www/html
WORKDIR /var/www/html

COPY database/ database/

COPY composer.json composer.json

COPY composer.lock composer.lock

RUN composer install --ignore-platform-reqs --no-interaction --no-plugins --no-progress --no-scripts --prefer-dist

RUN file="$(ls -a /var/www/html)" && echo $file

FROM php:8.1.12-fpm

WORKDIR /var/www/html

COPY --from=vendor /var/www/html /var/www/html

RUN apt-get update && apt-get install -y --no-install-recommends \
  zip \
  unzip \
  libicu-dev \
  libpq-dev \
  supervisor

RUN docker-php-ext-install intl pdo pdo_pgsql

#Для разработчиков
#RUN pecl install xdebug; \
#        { \
#            echo "[xdebug]"; \
#            echo "zend_extension=$(find /usr/local/lib/php/extensions/no-debug-non-zts-20190902 -name xdebug.so)"; \
#            echo "xdebug.mode=debug"; \
#            echo "xdebug.start_with_request=yes"; \
#            echo "xdebug.client_host=host.docker.internal"; \
#            echo "xdebug.client_port=9013"; \
#        } >> /usr/local/etc/php/conf.d/docker-php-xdebug.ini;
#RUN docker-php-ext-enable xdebug

RUN sed -i 's/9000/9009/' /usr/local/etc/php-fpm.d/zz-docker.conf


COPY public/ public/
COPY app/ app/
COPY storage/ storage/
COPY config/ config/
COPY bootstrap/ bootstrap/
COPY routes/ routes/
COPY resources resources/
COPY artisan .env ./

RUN php artisan key:generate
RUN php artisan cache:clear
RUN php artisan config:clear
RUN php artisan storage:link

#TODO: remove this
#RUN chown -R www-data:www-data /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 777 /var/www/html

RUN php artisan l5-swagger:generate

ADD supervisord.conf /etc/supervisor/conf.d/worker.conf

ENTRYPOINT ["supervisord"]
#CMD ["php-fpm"]
