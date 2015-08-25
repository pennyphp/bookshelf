FROM fntlnz/php:5.6.12

# Additional extensions

# XDEBUG
RUN wget -nv -O - http://xdebug.org/files/xdebug-2.3.3.tgz | tar zx
WORKDIR xdebug-2.3.3
RUN phpize
RUN ./configure
RUN make -j
RUN make install

# php-fpm
WORKDIR /var/www/penny-classic
RUN useradd fpm
VOLUME ["/usr/local/php/etc"]
ENTRYPOINT ["/usr/local/php/sbin/php-fpm"]
CMD ["-F"]
