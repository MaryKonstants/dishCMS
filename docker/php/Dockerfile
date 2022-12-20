FROM robote13/yii2-php:7.2-fpm

ARG uid
ARG gid
ARG username

RUN groupadd -g $gid $username
RUN useradd -m -u $uid -g $gid $username