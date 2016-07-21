#!/bin/bash
src=${PWD}
if [[ ${1} == "release" ]]; then
	deployto=${release}	
	cp -r ./* ${release}
	delete=false
else
	deployto=${master}
	cp -r ./* ${master}
	delete=true
fi

cd ${deployto}
composer install --no-dev --optimize-autoloader
php bin/console assetic:dump
php bin/console cache:clear
if [[ ${delete} == true ]]; then
	rm -rf ${src}
fi
