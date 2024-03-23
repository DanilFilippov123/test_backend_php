FROM php:apache
RUN docker-php-ext-install mysqli 
RUN docker-php-ext-enable mysqli
ENV MYSQL_DATABASE=my_db MYSQL_PASSWORD=pwd MYSQL_URL=localhost:3306 MYSQL_USER=usr
COPY ./ /var/www/html/