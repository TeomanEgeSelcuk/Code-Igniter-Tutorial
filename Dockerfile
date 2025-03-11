# filepath: c:\Users\Edge\Desktop\Coding\Code Igniter Tutorial\Dockerfile
FROM php:8.1-cli

# Install system dependencies including libicu-dev for intl extension
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libicu-dev \
    && rm -rf /var/lib/apt/lists/*

# Configure and install the intl and mysqli extensions
RUN docker-php-ext-configure intl && \
    docker-php-ext-install intl mysqli pdo pdo_mysql

# Install Composer (latest stable version)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory to /app
WORKDIR /app

# Copy the existing .env file
COPY .env /app/.env

# Install CodeIgniter dependencies when container starts
CMD composer install && php spark serve --host 0.0.0.0


# Build the image:
# docker build -t my-php-env .
# On CMD: docker run -it -p 8080:8080 -v "%CD%\app:/app" --name codeigniter-app my-php-env

# Dont need to do these but if needed to create a new project manually:
# docker exec -it codeigniter-app bash
# composer create-project codeigniter4/appstarter 
# php spark serve
# http://localhost:8080

