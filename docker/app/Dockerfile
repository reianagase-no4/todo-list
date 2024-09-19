# どんな docker イメージを利用して構築をするか
# FROM : ここではPHPの公式イメージである「php:7.4-apache」というあらかじめPHPとApacheがインストールされているイメージを、
# Docker Hubというサイトからダウンロードしてくるようになっている。
FROM php:7.4-apache

# 設定ファイルをdockerコンテナ内のPHP、Apacheに読み込ませる
# ADD：ローカルのファイルをDockerコンテナ内にコピーする
ADD php.conf.d/ext.ini /usr/local/etc/php/conf.d/

# MYSQL接続用のPDOをインストール
RUN docker-php-ext-install pdo_mysql
