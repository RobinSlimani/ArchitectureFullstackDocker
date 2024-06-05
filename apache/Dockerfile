FROM httpd:bookworm

COPY reverse-proxy.conf /usr/local/apache2/conf/reverse-proxy.conf

RUN sed -i '/LoadModule\ rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf
RUN sed -i '/LoadModule\ proxy_module/s/^#//g' /usr/local/apache2/conf/httpd.conf && \
    sed -i '/LoadModule\ proxy_http_module/s/^#//g' /usr/local/apache2/conf/httpd.conf

RUN echo "Include /usr/local/apache2/conf/reverse-proxy.conf" >> /usr/local/apache2/conf/httpd.conf

EXPOSE 80
