#!/usr/bin/env bash

apt-get update
apt-get -y install aptitude
export DEBIAN_FRONTEND=noninteractive && aptitude -y safe-upgrade && export DEBIAN_FRONTEND=dialog
aptitude -y install sudo
aptitude -y install aptitude
aptitude -y install curl
aptitude -y install php5-mcrypt
aptitude -y install php5-curl
aptitude -y install php5-intl
aptitude -y install php5-xsl

rm -f /etc/apache2/sites-enabled/000-default.conf
rm -f /etc/apache2/sites-enabled/magento2.lxc.conf
ln -s /var/www/magento2/architecture/conf/apache/magento2.lxc.conf /etc/apache2/sites-enabled/magento2.lxc.conf

rm -f /etc/php5/apache2/conf.d/99-magento2.ini
ln -s /var/www/magento2/architecture/conf/php/magento2.apache2.ini /etc/php5/apache2/conf.d/99-magento2.ini

rm -f /etc/php5/cli/conf.d/99-magento2.ini
ln -s /var/www/magento2/architecture/conf/php/magento2.cli.ini /etc/php5/cli/conf.d/99-magento2.ini

service apache2 restart

/var/www/magento2/architecture/script/permissions.sh

/var/www/magento2/architecture/script/createDb.sh

