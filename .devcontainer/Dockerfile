# See here for image contents: https://github.com/microsoft/vscode-dev-containers/tree/v0.177.0/containers/php/.devcontainer/base.Dockerfile

# [Choice] PHP version: 8, 8.0, 7, 7.4, 7.3
ARG VARIANT="8.0"
FROM mcr.microsoft.com/vscode/devcontainers/php:0-${VARIANT}

# [Option] Install Node.js
ARG USER_UID=1000
ARG USER_GID=$USER_UID
RUN if [ "$USER_GID" != "1000" ] || [ "$USER_UID" != "1000" ]; then groupmod --gid $USER_GID vscode && usermod --uid $USER_UID --gid $USER_GID vscode; fi

ARG INSTALL_NODE="true"
ARG NODE_VERSION="lts/*"
RUN if [ "${INSTALL_NODE}" = "true" ]; then su vscode -c "umask 0002 && . /usr/local/share/nvm/nvm.sh && nvm install ${NODE_VERSION} 2>&1"; fi

# [Optional] Uncomment this section to install additional OS packages.
# RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
#     && apt-get -y install --no-install-recommends <your-package-list-here>

# [Optional] Uncomment this line to install global node packages.
# RUN su vscode -c "source /usr/local/share/nvm/nvm.sh && npm install -g <your-package-here>" 2>&1


#SYS TOOLSD
RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install -y vim vifm curl imagemagick imagemagick-doc 



#START PHP 
#PHP LIBS
RUN apt-get update \
    && apt-get install -y libssl-dev libzip-dev firebird-dev freetds-dev freetds-bin freetds-common libldb-dev libldap2-dev libc-client-dev libc-client-dev libkrb5-dev libgmp-dev libpq-dev libenchant-dev libcurl4-openssl-dev libbz2-dev libmcrypt-dev libicu-dev libpng-dev libxml2-dev msmtp bash && rm -r /var/lib/apt/lists/* \
    && ln -s /usr/lib/x86_64-linux-gnu/libsybdb.so /usr/lib/ \
    && mkdir /etc/php.d \
    && ln -s /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-source extract \
    && docker-php-ext-install bcmath bz2 calendar gd intl opcache pdo_pgsql pgsql zip \ 
    && docker-php-ext-enable pgsql \
    && docker-php-ext-enable opcache \
    && docker-php-source delete 
# ADDITONAL PHP EXTENSIONS bcmath bz2 calendar dba enchant exif ffi gd gettext gmp imap intl ldap mysqli opcache pcntl pdo_dblib pdo_firebird pdo_mysql pdo_pgsql pgsql posix pspell shmop snmp soap sockets spl standard sysvmsg sysvsem sysvshm tidy tokenizer xsl zend_test zip 

#RUN pecl install mongodb redis \
#    && docker-php-ext-enable mongodb \
#    && docker-php-ext-enable redis \
#    && docker-php-source delete 


#SYMFONY
RUN sudo curl -sS https://get.symfony.com/cli/installer | sudo bash && sudo mv /root/.symfony/bin/symfony /usr/local/bin/symfony

#END PHP

#RUST
USER vscode
RUN curl --proto '=https' --tlsv1.2 -sSf https://sh.rustup.rs | sh -s -- -y 

ENV PATH="/home/vscode/.cargo/bin:${PATH}"
RUN cargo install sd


