Version php: 7.1<
Version node.js: 8.4
install composer
install npm
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
npm run dev
php bin/console server:start

