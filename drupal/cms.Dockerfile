FROM drupal:11.3.16-php8.4-apache-trixie

RUN apt-get update -y && apt-get install vim -y

# Install composer dependencies
WORKDIR /opt/drupal
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-dev

# Set up drush
RUN ln -s /opt/drupal/vendor/bin/drush /usr/bin/drush

# Copy module files
COPY web/modules/custom /opt/drupal/web/modules/custom

# Expose port for Apache
EXPOSE 80
