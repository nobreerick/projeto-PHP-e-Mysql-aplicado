FROM debian:latest
WORKDIR /var/www/app
## instalando ferramentas
RUN apt-get update && apt-get install -y \
    sudo \
    build-essential \
    cmake \
    git \
    wget \
    curl \
    vim \
    git-all
## instalando PHP
RUN apt install -y php-common libapache2-mod-php php-cli
## instalando composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }" && \
    sudo php composer-setup.php && \
    php -r "unlink('composer-setup.php');"
RUN sudo mv composer.phar /usr/local/bin/composer
RUN sudo apt install php8.2-sqlite3 && \
    sudo apt install php8.2-mysql   
ENTRYPOINT ["/bin/bash", "-c", "while true; do sleep 1; done"]
CMD ["git bash"]
