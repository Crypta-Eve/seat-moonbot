# seat-moonbot
A module for [SeAT](https://github.com/eveseat/seat) that creates an API endpoint for various moon stats

[![Latest Stable Version](https://img.shields.io/packagist/v/cryptaeve/seat-moonbot.svg?style=flat-square)]()
[![License](https://img.shields.io/badge/license-GPLv2-blue.svg?style=flat-square)](https://raw.githubusercontent.com/crypta-eve/seat-squad-sync/master/LICENSE)

## Usage


## Quick Installation
### Docker Install

Open the .env file (which is most probably at /opt/seat-docker/.env) and edit the SEAT_PLUGINS variable to include the package. 

```
# SeAT Plugins
# This is a list of the all of the third party plugins that you
# would like to install as part of SeAT. Package names should be
# comma separated if multiple packages should be installed.
SEAT_PLUGINS=cryptaeve/seat-moonbot
```

Save your .env file and run docker-compose up -d to restart the stack with the new plugins as part of it. Depending on how many other plugins you also may have, this could take a while to complete.

You can monitor the installation process by running:

docker-compose logs --tail 5 -f seat-app

### Blade Install

In your seat directory (By default:  /var/www/seat), type the following:

```
php artisan down
composer require cryptaeve/seat-moonbot

php artisan vendor:publish --force --all
php artisan migrate

php artisan up
```

And now, when you log into 'Seat', you should see a 'MoonBot' link on the left.


## Usage Tracking

In order to get an idea of the usage of this plugin, a very simplistic form of anonymous usage tracking has been implemented.

Read more about the system in use [here](https://github.com/Crypta-Eve/snoopy)