#!/usr/bin/env bash
# usage: typo3_LfPHP_setup.sh DB_USER DB_PWD DB_NAME ADMIN_USER ADMIN_PWD SITE_URL DRIVER BASE_DIR INTRO_PKG
#        DRIVER : pdo_mysql | pdo_sqlite
export VER="10"
export TYPO3_DB_USER=$1
export TYPO3_DB_PWD=$2
export TYPO3_DB_NAME=$3
export TYPO3_ADMIN_USER=$4
export TYPO3_ADMIN_PWD=$5
export TYPO3_URL=$6
export TYPO3_DRIVER=$7
export TYPO3_BASE=$8
export TYPO3_INTRO_PKG=$9
export TYPO3_CFG_FN=$10
if [[ "$TYPO3_DRIVER" = "pdo_mysql" ]]; then
    /etc/init.d/mysql start
    sleep 5
    mysql -root -v -e "CREATE USER IF NOT EXISTS '$TYPO3_DB_USER'@'localhost' IDENTIFIED BY '$TYPO3_DB_PWD';"
    mysql -uroot -v -e "GRANT ALL PRIVILEGES ON *.* TO '$TYPO3_DB_USER'@'localhost';"
    mysql -uroot -v -e "FLUSH PRIVILEGES;"
else
    export TYPO3_DRIVER="pdo_sqlite"
fi
if [[ -z "$TYPO3_BASE" ]]; then
    export TYPO3_BASE="/srv"
fi
cd $TYPO3_BASE
wget https://getcomposer.org/download/1.10.20/composer.phar
php composer.phar create-project typo3/cms-base-distribution typo3 $VER.*
mv composer.phar typo3
cd typo3
# See: https://docs.typo3.org/p/helhum/typo3-console/master/en-us/CommandReference/InstallSetup.html
if [[ "$TYPO3_DRIVER" = "pdo_sqlite" ]]; then
    vendor/bin/typo3cms install:setup -f --database-host-name localhost --database-driver pdo_sqlite --database-name $TYPO3_DB_NAME --admin-user-name $TYPO3_ADMIN_USER --admin-password $TYPO3_ADMIN_PWD --site-name $TYPO3_URL --web-server-config apache --site-setup-type site --site-base-url /typo3/ --no-interaction
else
    vendor/bin/typo3cms install:setup -f --database-host-name localhost --database-driver $TYPO3_DRIVER --database-name $TYPO3_DB_NAME --database-user-name $TYPO3_DB_USER --database-user-password "$TYPO3_DB_PWD" --admin-user-name $TYPO3_ADMIN_USER --admin-password "$TYPO3_ADMIN_PWD" --site-name $TYPO3_URL --web-server-config apache --site-setup-type site --site-base-url /typo3/ --no-interaction
fi
if [[ -z "$TYPO3_INTRO_PKG" ]]; then
    echo "No intro package installed ..."
else
    php composer.phar req --update-with-all-dependencies typo3/cms-introduction
    vendor/bin/typo3cms extension:activate bootstrap_package
    vendor/bin/typo3cms extension:activate introduction
    mkdir -vp config/sites/main
    cp $TYPO3_CFG_FN config/sites/main/config.yaml
fi
vendor/bin/typo3cms database:updateschema --no-interaction
vendor/bin/typo3cms cache:flush
if [[ $? -gt 0 ]]; then
    echo -e "\ntypo3 Installation ERROR!  Aborting!\n"
    exit 1
fi
echo -e "\ntypo3 installed into $TYPO3_BASE/typo3\n"
cd
