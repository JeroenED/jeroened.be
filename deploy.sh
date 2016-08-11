#!/bin/bash

if [[ ${CI_BUILD_REF_NAME} == "release" ]]; then
	deployto=${release}	
	cp -r ./* ${release}
else
	deployto=${master}
	cp -r ./* ${master}
fi

cd ${deployto}
composer install --no-dev --optimize-autoloader
php bin/console assetic:dump
php bin/console doctrine:schema:update --force
php bin/console cache:clear
