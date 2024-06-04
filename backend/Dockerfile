# Utiliser une image Node.js 18
FROM node:18

# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers de package et installer les dépendances
# RUN npm install
# RUN npm update
# RUN npm audit fix --force

# Copier le reste de l'application
COPY . .

# Exposer le port 3000 pour le back-end
EXPOSE 3000

CMD ["node", "server.js"]

