
FROM php:7.0-apache
ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update && \
    apt-get install -y \
        libxml2-dev \
        libpng12-dev \
        libjpeg-dev \
        zlib1g-dev \
        libicu-dev \
        git \
        locales && \

    rm -rf /var/lib/apt/lists/*

# bcmath bz2 calendar ctype curl dba dom enchant exif
# fileinfo filter ftp gd gettext gmp hash iconv imap
# interbase intl json ldap mbstring mcrypt mysqli
# oci8 odbc opcache pcntl pdo pdo_dblib pdo_firebird pdo_mysql pdo_oci pdo_odbc pdo_pgsql pdo_sqlite pgsql phar posix pspell readline recode reflection session shmop simplexml snmp soap sockets spl standard sysvmsg sysvsem sysvshm tidy tokenizer wddx xml xmlreader xmlrpc xmlwriter xsl zip
RUN docker-php-ext-install \
    mysqli pdo_mysql zip bcmath

RUN docker-php-ext-install intl

RUN docker-php-ext-configure gd --with-png-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd

RUN rm -rf /etc/apache2/sites-enabled

RUN a2enmod rewrite

RUN docker-php-ext-install bcmath

RUN echo "th_TH.UTF-8 UTF-8" > /etc/locale.gen && \
    locale-gen th_TH.UTF-8 && \
    dpkg-reconfigure locales

ADD ./docker/apache/sites-enabled /etc/apache2/sites-enabled

ADD ./ /var/www/html/

CMD ["apache2-foreground"]

