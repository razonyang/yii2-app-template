FROM yiisoftware/yii2-php:7.4-apache

ENV APACHE_DOCUMENT_ROOT /app/public

RUN sed -ri -e 's!/app/web!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

COPY . /app

RUN git config --global url."git@github.com:".insteadOf "https://github.com/"

RUN composer install

RUN /app/bin/init --env=Production --overwrite=All

RUN /app/bin/yii migrate
