FROM php:7.3-fpm

RUN apt-get update -yqq \
    && apt-get install git -yqq

RUN curl -Ss https://getcomposer.org/installer | php -- --filename=composer \
    && chmod a+x composer \
    && mv composer /usr/local/bin/composer \
    && composer -q global require hirak/prestissimo