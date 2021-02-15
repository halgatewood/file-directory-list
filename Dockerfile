FROM php:8.0-apache
VOLUME ['/var/www/html/']
COPY index.php flat.png /var/www/html/
