FROM node:22-alpine

WORKDIR /app

COPY ./frontend-user/package*.json ./

RUN npm install

CMD ["npm", "run", "dev"]