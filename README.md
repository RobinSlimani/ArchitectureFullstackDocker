# ArchitectureFullstackDocker

Instructions pour construire et exécuter l’application
Prérequis

    Docker et Docker Compose installés sur votre machine.

Étapes pour construire et exécuter l'application

    Cloner le dépôt

	git clone https://github.com/RobinSlimani/ArchitectureFullstackDocker.git
	cd ArchitectureFullstackDocker

    Construire les conteneurs Docker

	docker-compose build
    Démarrer les conteneurs Docker

	docker-compose up

    Accéder à l'application

	Front-end : Accédez à http://localhost:8080
	Back-end : L'API est accessible à http://localhost:5000
	Base de données : Non accessible directement pour des raisons de sécurité

    Arrêter les conteneurs

	docker-compose down

Structure du projet

    frontend/ : Contient le code source Vue.js pour l'interface utilisateur.
    backend/ : Contient le code source du serveur applicatif, probablement en Node.js/Express.
    database/ : Contient les configurations pour la base de données PostgreSQL.
    docker-compose.yml : Fichier de configuration pour orchestrer les conteneurs Docker.

Scripts supplémentaires

    insert-script.sh : Script d'insertion de données initiales dans la base de données.
    clean.sh : Script pour nettoyer les données de la base de données.

Justification des choix techniques et configurations de sécurité

    Séparation des responsabilités :
        Front-end : Utilisation de Vue.js pour une interface utilisateur réactive.
        Back-end : Node.js/Express pour une gestion efficace des requêtes HTTP et de la logique métier.
        Base de données : PostgreSQL pour une gestion robuste et fiable des données.

Docker :

    Isolation : Chaque composant de l'application est isolé dans un conteneur Docker distinct pour une meilleure gestion et une isolation des dépendances.
    Scalabilité : La configuration Docker permet de scaler les services individuellement selon les besoins.

Sécurité :
    Fermeture des ports non nécessaires : Seuls les ports essentiels (8080 pour le front-end, 5000 pour le back-end) sont ouverts. La base de données n'est pas directement accessible de l'extérieur.

    Communication restreinte : La base de données ne communique qu'avec le back-end, évitant toute exposition directe à l'extérieur.

    Justification des ports :

    8080 : Port standard pour les applications web front-end, nécessaire pour accéder à l'interface utilisateur.
    5000 : Utilisé par le serveur back-end pour gérer les requêtes API.
    Ports internes : Les ports de la base de données et autres communications internes ne sont pas exposés publiquement, minimisant les risques de sécurité.
