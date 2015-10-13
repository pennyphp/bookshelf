FROM fntlnz/php:5.6.14

WORKDIR /tmp

# Additional extensions

WORKDIR /tmp

# Redis
RUN wget -nv -O - https://pecl.php.net/get/redis-2.2.7.tgz | tar zx
WORKDIR redis-2.2.7
RUN phpize
RUN ./configure
RUN make -j
RUN make install

# php-fpm
WORKDIR /var/www

RUN useradd fpm

VOLUME ["/usr/local/php/etc"]
#ENTRYPOINT ["/usr/local/php/sbin/php-fpm"]
#CMD ["-F"]

ENTRYPOINT ["ls"]
CMD ["/usr/local/php/etc"]