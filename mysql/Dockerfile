FROM mysql:8.0

# Copier le fichier init.sql dans le conteneur
COPY init.sql /docker-entrypoint-initdb.d/

# Définir les variables d'environnement pour MySQL
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=contacts_db

EXPOSE 3306
