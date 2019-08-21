FROM razonyang/php-cron:7.2
RUN apt-get update

# Intl
RUN apt-get install -y \
        zlib1g-dev \
        libicu-dev \
        g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

# MySQL
RUN docker-php-ext-install pdo_mysql

# PostgreSQL
RUN apt-get update && apt-get install -y \
        libpq-dev \
    && docker-php-ext-install pdo_pgsql