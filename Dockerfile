FROM ubuntu:16.04

# Install some apps
RUN apt-get update && \
    apt-get install -y apache2 && \
    apt-get install -y php7.0 libapache2-mod-php7.0 && \
    apt-get install -y php7.0-gd && \
    apt-get install -y php7.0-xml && \
    apt-get install -y php-mbstring && \
    apt-get install -y php-curl && \
    apt-get install -y php7.0-bcmath && \
    apt-get install -y php7.0-mysql && \
    apt-get install -y php7.0-sqlite3 && \
    apt-get install -y mcrypt php7.0-mcrypt && \
    apt-get install -y mc && \
    apt-get install -y cron && \
    apt-get install -y git && \
    apt-get install -y unzip && \
    apt-get install -y wget &&\
    apt-get install -y curl && \
    apt-get install -y supervisor && \
    curl -sL https://deb.nodesource.com/setup_6.x | bash - && \
    apt-get update && \
    apt-get install -y nodejs && \
    npm i alertify-webpack && \
    npm install geocomplete && \
    apt-get install -y build-essential

# Configure apache
RUN rm -rf /var/www/html && ln -fs /app/public /var/www/html && \
    a2enmod rewrite && \
    a2enmod headers && \
    sed -i 's/<VirtualHost \*:80>/<VirtualHost \*:80>\n<Directory \/var\/www\/html>\nOptions Indexes FollowSymLinks MultiViews\nAllowOverride All\nOrder allow,deny\nallow from all\n<\/Directory>/g' /etc/apache2/sites-available/000-default.conf

# Configure mysql
RUN echo mysql-server mysql-server/root_password password 12345 | debconf-set-selections && \
    echo mysql-server mysql-server/root_password_again password 12345 | debconf-set-selections && \
    apt-get install -y mysql-server && \
    sed -i 's/bind-address/#bind-address/g' /etc/mysql/mysql.conf.d/mysqld.cnf && \
    service mysql start && \
    mysql -uroot -p12345 -e "CREATE DATABASE \`forge\` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_unicode_ci" && \
    mysql -uroot -p12345 -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '12345';"

# Set the working directory
WORKDIR /app

# Copy script to container
COPY ./DockerStart.sh /var/DockerStart.sh

# Copy supervisor conf
#COPY ./supervisor-workers.conf /etc/supervisor/conf.d/supervisor-workers.conf

# Make ports available to the world outside this container
EXPOSE 80
EXPOSE 3306
EXPOSE 9090

# Define environment variable
ENV NAME Dev

# Run when the container launches
CMD ["/var/DockerStart.sh"]
