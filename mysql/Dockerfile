FROM mysql:8.0

# Copier le fichier init.sql dans le conteneur
COPY init.sql /docker-entrypoint-initdb.d/

# Définir les variables d'environnement pour MySQL
ENV MYSQL_ROOT_PASSWORD=education
ENV MYSQL_DATABASE=contatcs_db

# Exposer le port MySQL
EXPOSE 3306
