FROM bitnami/apache
LABEL maintainer "Bitnami <containers@bitnami.com>"

## Change user to perform privileged actions
USER 0

## Install librairies (PHP8, ...)
RUN install_packages apt wget git;

RUN apt update \
    && apt install -y lsb-release ca-certificates apt-transport-https software-properties-common gnupg2 apache2 apache2-bin apache2-data apache2-utils libapr1 libaprutil1 libaprutil1-dbd-sqlite3 libaprutil1-ldap libbrotli1 libbsd0 libedit2 libjansson4 liblua5.2-0 libsodium23 php-common psmisc ssl-cert php-pear;

RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/sury-php.list;
    
RUN wget -qO - https://packages.sury.org/php/apt.gpg | apt-key add -;

RUN dpkg -l | grep php | tee packages.txt;

RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg;

RUN sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list';

RUN apt update \
    && apt install php8.0-common php8.0-cli -y;

# Additional PHP8 extensions
RUN apt update \
    && apt install php8.0-bz2 php8.0-curl php8.0-intl php8.0-readline php8.0-xml php-fpm php8.0-fpm;

#To bind apache and PHP
RUN a2enmod proxy_fcgi;
RUN a2enconf php8.0-fpm;

RUN apt update \
    && apt install php8.0-pcov php8.0-xdebug;

# PHP8 server APIs for apache installation
RUN apt update \
    && apt install libapache2-mod-php8.0;

# Make installation
RUN apt update \
    && apt install make;

# Nano installation
RUN apt update \
    && apt install nano;


# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php && php -r "unlink('composer-setup.php');" && mv composer.phar /usr/local/bin/composer

# Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv //.symfony/bin/symfony /usr/local/bin/symfony


# CMD bash -c "symfony composer install"
# RUN symfony composer install

# ## Revert to the original non-root user
# USER 1001

## Modify the ports used by Apache by default
# It is also possible to change these environment variables at runtime
ENV APACHE_HTTP_PORT_NUMBER=8080
EXPOSE 8080 8443

# ## Modify the default container user
# USER 1002
