FROM php:8.2-cli

# Install system dependencies and PHP extensions
RUN apt update && apt install -y \
    git \
    unzip \
    zip \
    libxml2-dev \
    libzip-dev \
    wget \
    curl \
    && docker-php-ext-install \
        dom \
        xml \
        zip \
        pdo \
        pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Install Symfony CLI globally
RUN wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony \
    && chmod +x /usr/local/bin/symfony

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Accept user ID and group ID as build arguments
ARG USER_ID=1000
ARG GROUP_ID=1000

# Create a user with the same UID/GID as host user
RUN groupadd -g $GROUP_ID appuser && \
    useradd -u $USER_ID -g $GROUP_ID -m -s /bin/bash appuser

WORKDIR /var/www/html

# Change ownership of work directory
RUN chown -R appuser:appuser /var/www/html

# Switch to the app user
USER appuser

# Expose port
EXPOSE 8000

# Default command
CMD ["symfony", "serve", "--no-interaction", "--port=8000", "--allow-http", "--allow-all-ip"]