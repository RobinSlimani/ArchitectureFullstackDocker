# Utiliser une image Node.js 18 pour le build
FROM node:18 AS build-stage

# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers de package et installer les dépendances
# COPY package*.json ./
# RUN npm install

# Copier le reste de l'application et construire
COPY . .
RUN npm run build

# Utiliser une image Nginx pour servir l'application
FROM nginx:1.21.3-alpine AS production-stage

COPY --from=build-stage /app/dist /usr/share/nginx/html

# Exposer le port 80 pour accéder à l'application
EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]

