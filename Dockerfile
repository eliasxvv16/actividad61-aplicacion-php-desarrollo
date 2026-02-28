FROM ubuntu:24.04

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Europe/Madrid
ENV MARIADB_HOST=mariadb
ENV MARIADB_DATABASE=wutheringwaves
ENV MARIADB_USER=usuarioelha
ENV MARIADB_PASSWORD=eliashalloumi@2005

RUN apt-get update && \
    apt-get install -y apache2 php php-mysql libapache2-mod-php curl && \
    rm -rf /var/lib/apt/lists/*

# Copiar configuración de Apache
COPY conf/000-default.conf /etc/apache2/sites-available/

# Copiar aplicación PHP
COPY src/ /var/www/html/

# Habilitar módulo rewrite de Apache
RUN a2enmod rewrite

EXPOSE 80

ENTRYPOINT ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]