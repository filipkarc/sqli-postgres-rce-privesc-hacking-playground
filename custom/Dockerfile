FROM postgres:9.3
RUN apt-get update -y; apt-get install apt-utils -y; apt-get install apache2 curl -y; rm /var/www/html/index.html; apt-get install software-properties-common -y
RUN apt-get install php7.0 libapache2-mod-php php7.0-pgsql vim -y; chmod u+s /usr/bin/vim
COPY data.sql /data.sql
COPY data /var/www/html
CMD sleep 6; pg_createcluster 9.3 main; /etc/init.d/postgresql start; service apache2 restart; su - postgres -c "psql -f /data.sql"; sleep infinity
