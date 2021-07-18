FROM nginx:latest

COPY server.conf /etc/nginx/conf.d/default.conf
COPY ssl/server.crt /etc/nginx/ssl/server.crt
COPY ssl/server.key /etc/nginx/ssl/server.key

EXPOSE 80 443

CMD ["nginx", "-g", "daemon off;"]
