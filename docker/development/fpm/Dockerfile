FROM fntlnz/php:5.6.13

WORKDIR /tmp

# Additional extensions

# Z-Ray
RUN wget -nv -O - http://downloads.zend.com/zray/1208//zray-php5.6-Ubuntu-14.04-x86_64.tar.gz | tar zx
RUN mv /tmp/zray /opt/zray

# XDEBUG
RUN wget -nv -O - http://xdebug.org/files/xdebug-2.3.3.tgz | tar zx
WORKDIR xdebug-2.3.3
RUN phpize
RUN ./configure
RUN make -j
RUN make install

# Copy configuration
COPY etc/ /usr/local/php/etc

# php-fpm
WORKDIR /var/www/penny-classic

RUN useradd fpm
RUN chown -R fpm /opt/zray
VOLUME ["/usr/local/php/etc"]
VOLUME ["/opt/zray"]
ENTRYPOINT ["/usr/local/php/sbin/php-fpm"]
CMD ["-F"]
