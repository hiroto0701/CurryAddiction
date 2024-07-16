FROM node:22-alpine

WORKDIR /app

COPY ./frontend-admin/package*.json ./

RUN npm install

CMD ["npm", "run", "dev"]