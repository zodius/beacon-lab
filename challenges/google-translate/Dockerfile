FROM php:8.2-apache

# 安裝系統依賴
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# 安裝 Redis 擴展
RUN pecl install redis \
    && docker-php-ext-enable redis

# 啟用 Apache rewrite 模組
RUN a2enmod rewrite

# 暴露端口
EXPOSE 80

# 啟動 Apache
CMD ["apache2-foreground"]
