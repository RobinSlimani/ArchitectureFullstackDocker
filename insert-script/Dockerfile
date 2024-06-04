FROM node:18

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY insert-script.js .

CMD ["node", "insert-script.js"]

