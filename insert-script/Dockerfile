# Utiliser une image Node.js 18
FROM node:18

# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers de package et installer les dépendances
COPY package*.json ./
RUN npm install

# Copier le script d'insertion
COPY insert-script.js .

CMD ["node", "insert-script.js"]

