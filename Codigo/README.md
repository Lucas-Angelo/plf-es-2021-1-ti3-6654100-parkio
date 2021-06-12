# PARKIO

PARKIO Description (Yet to be made)

## Instruções de utilização

``` bash
$ git clone https://github.com/ICEI-PUC-Minas-PPLES-TI/plf-es-2021-1-ti3-6654100-parkio.git
$ cd plf-es-2021-1-ti3-6654100-parkio/Codigo
```
#### Altere as informações de autenticação do banco
``` bash
$ mv .env.example .env
```
#### Instalar atualizações
``` bash
$ composer update
```
#### Instalar banco de dados
``` bash
$ php artisan migrate
$ php artisan db:seed
```
#### Rodar a aplicação localmente
``` bash
$ php -S 0.0.0.0:80 -t public
```
## License

The ParkIO Project is open-sourced software licensed under the [Creative Commons Attribution 4.0 International](https://creativecommons.org/licenses/by/4.0/).
