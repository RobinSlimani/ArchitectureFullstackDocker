# Instructions pour construire et exécuter l’application

## Prérequis

- Docker et Docker Compose installés sur votre machine.

## Étapes pour construire et exécuter l'application

1. Cloner le dépôt
    ```bash
    git clone https://github.com/RobinSlimani/ArchitectureFullstackDocker.git
    cd ArchitectureFullstackDocker
    ```

2. Construire les conteneurs Docker
    ```bash
    sh lance.sh
    ```
    Il est possible de lancer directement le `lance.sh` avec `$sh lance.sh`. Celui-ci va faire une suppression des images et conteneurs lancés par l'application si elle avait déjà été lancée, sinon il va simplement démarrer l'application avec `docker compose up`.

3. Accéder à l'application
    - **Front-end :** Accédez à [http://localhost:8080](http://localhost:8080) (nginx) ou [http://localhost:8081](http://localhost:8081) (apache)
    - **Base de données :** Il y a un phpMyAdmin accessible depuis [http://localhost:8082](http://localhost:8082) (ce n'est pas très sécurisé mais on trouvait cela intéressant d'avoir une version visuelle des données).

4. Arrêter les conteneurs
    ```bash
    docker compose down --rmi local
    ```
    Ou alors, simplement si on veut redémarrer l'application, on peut faire `$sh lance.sh`.

## Structure du projet

- `apache/` : Contient le serveur apache (front-end) avec le Dockerfile pour créer l'image.
- `nginx/` : Contient le serveur nginx (front-end) comme l'apache.
- `php/` : Contient l'application et fait donc office de back-end. C'est avec l'image créée par le Dockerfile qu'on fait 2 conteneurs php.
- `phpmyadmin/` : Contient le phpMyAdmin qui permet de voir la base de données.
- `mysql/` : Contient la méthode de création de la base de données et l'image MySQL.
- `docker-compose.yml` : Fichier de configuration pour orchestrer les conteneurs Docker.

## Docker

- **Isolation :** Chaque composant de l'application est isolé dans un conteneur Docker distinct pour une meilleure gestion et une isolation des dépendances.
- **Communication restreinte :** La base de données ne communique qu'avec le back-end, pour éviter l'exposition directe à l'extérieur.

## Justification des ports

- **8080 / 8081 / 8082 :** Ce sont les ports standards pour une connexion web même si on aurait aussi pu prendre le port 80 qui est le port de base de http.
- Les ports de la base de données et autres communications internes ne sont pas exposés publiquement, pour réduire les problèmes de sécurité.

