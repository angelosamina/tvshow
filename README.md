# SAE 2.01 - Développement d’une application

SAMINA Angelo sami0002
CHOQUET Tristan choq0003

## Serveur Web local :
* Pour lancer le serveur web local, il faut ce mettre à la racine de notre projet et lancer la commande : php -d display_errors -S localhost:8000 -t public/
  puis acceder à la page grace à l'URL : http://localhost:8000

### Style de codage
* Nous avons installé PHP CS FIXER afin de suivre la recommandation de codage PSR-12.
* Ensuite pour voir s'il y a des erreurs on utilise la commande : 
        php vendor/bin/php-cs-fixer fix --dry-run --diff
* Et l'on peut directement modifier sans regarder les errerus avec : 
        php vendor/bin/php-cs-fixer fix