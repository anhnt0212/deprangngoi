#Generate Bundle
php app/console doctrine:generate:entities AppBundle
#Create super admin
php app/console fos:user:create adminuser --super-admin
#Update entity
php app/console doctrine:schema:update --force
#clear cache for production
php app/console cache:clear --env=prod --no-debug
#install assetic
php app/console assetic:dump --env=prod --no-debug

