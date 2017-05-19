#!/bin/bash
command=${1}

case "${command}" in
	install)
		firsttime=${2}
		git submodule update --init --recursive
		composer install --no-dev --optimize-autoloader

		if [[ ${firsttime} == "--firsttime" ]]; then
			php bin/console doctrine:database:create
			php bin/console doctrine:schema:update --force
			php bin/console doctrine:fixtures:load
			php bin/console CmsED:Users:Create
		fi

		php bin/console assetic:dump
		php bin/console doctrine:schema:update --force
		rm -rf var/cache/{prod,dev}
		;;

	update)
		composer update		
		git submodule update --init --recursive
		php bin/console assetic:dump
		php bin/console doctrine:schema:update --force
		rm -rf var/cache/{prod,dev}
		;;

	release)
		version=${2}
		if [[ -z "${version}" ]]; then
			echo -e "\e[41m                                                 \e[49m"
			echo -e "\e[41m   \e[1m[error]\e[0m\e[41m                                       \e[49m"
			echo -e "\e[41m   version not provided.                         \e[49m"
			echo -e "\e[41m                                                 \e[49m"
			exit 4
		fi
		git checkout master
		sed -i "/        version:/c\        version:       \"${version}\"" app/config/config.yml
		git add app/config/config.yml
		git commit -m "Version Bump"
		git checkout release
		git merge master -m"${version} release"
		git tag "${version}"
		git push --force
		git checkout master
		git push --force
		git push --tags

		echo -e "\e[42m                                                 \e[49m"
		echo -e "\e[42m   \e[1m[OK]\e[0m\e[42m                                          \e[49m"
		echo -e "\e[42m   Version released                              \e[49m"
		echo -e "\e[42m                                                 \e[49m"
		;;

	push)
		message=${2}
		if [[ -z "${message}" ]]; then
			echo -e "\e[41m                                                 \e[49m"
			echo -e "\e[41m   \e[1m[error]\e[0m\e[41m                                       \e[49m"
			echo -e "\e[41m   message not provided.                         \e[49m"
			echo -e "\e[41m                                                 \e[49m"
			exit 4
		fi
		git add -A
		git commit -m"${message}"
		git push --force

		echo -e "\e[42m                                                 \e[49m"
		echo -e "\e[42m   \e[1m[OK]\e[0m\e[42m                                          \e[49m"
		echo -e "\e[42m   Pushed to server                              \e[49m"
		echo -e "\e[42m                                                 \e[49m"
		;;
	server)
		action=${2}
		if [ "${action}" != "start" ]  && [ "${action}" != "stop" ]; then
			echo -e "\e[41m                                                 \e[49m"
			echo -e "\e[41m   \e[1m[error]\e[0m\e[41m                                       \e[49m"
			echo -e "\e[41m   Action not provided                           \e[49m"
			echo -e "\e[41m                                                 \e[49m"
			exit 4
		fi
		ip=${3}
		php bin/console server:${action} ${ip}
		;;
esac