<h3 align="center">
    <img width="300px" src="https://i.imgur.com/M5hKaQc.png">
    <br><br>
    <p align="center">
      <a href="#-sobre">Sobre</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
      <a href="#-alunos-integrantes-da-equipe">Alunos Integrantes da Equipe</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
      <a href="#-professoras-responsáveis">Professoras responsáveis</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
      <a href="#-tecnologias">Tecnologias</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
      <a href="#-instruções-de-utilização">Instruções de utilização</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
      <a href="#-licença">Licença</a>
  </p>
</h3>

<p align="center">
  <a href="https://github.com/ICEI-PUC-Minas-PPLES-TI/plf-es-2021-1-ti3-6654100-parkio">
    <img src="https://i.imgur.com/uEbbTaZ.jpg">
  </a>
</p>

## 🔖 Sobre

O Condomínio do Conjunto Habitacional Santa Terezinha possui cerca de 918 apartamentos, porém há somente 2 portarias e aproximadamente 800 vagas que são de acesso aos moradores e aos visitantes do condomínio. Considerando os fatos acima, há um empecilho para controlar o fluxo dos veículos de uma maneira ágil e segura.

À todo momento, veículos entram e saem do condomínio, e o controle de quanto tempo os veículos visitantes ficam dentro do condomínio é difícil de ser realizado. Atualmente, há rondas que ajudam neste processo, porém, o gerenciamento é prejudicado devido ao fluxo alto.

O <strong>ParkIO</strong> é uma aplicação web, desenvolvida com o intuito de permitir que as portarias do Condomínio do Conjunto Habitacional Santa Terezinha controlem a entrada e saída dos veículos visitantes. Dessa forma, por meio dessa aplicação, a administração do condomínio consiguirá verificar quais são os veículos que estão a mais tempo dentro do condomínio, ocupando as poucas vagas que o estacionamento comunitário oferece.

Com esta aplicação vai ser possível realizar um gerenciamento mais amplo do condomínio. Os síndicos poderão visualizar a lista de veículos, desta forma, possibilitando uma atuação precisa em determinado problema, o mesmo se aplica a outros usuários, que utilizando o sistema de forma correta, oferecerá aos moradores do condomínio um ambiente mais seguro, controlado e ágil.

## 👨‍💻 Alunos integrantes da equipe

* [Guilherme Gabriel Silva Pereira](https://github.com/guizombas)
* [Henrique Penna Forte Monteiro](https://github.com/Henrikkee)
* [José Maurício Guimarães França](https://www.linkedin.com/in/josemauriciogf/)
* [Lucas Ângelo Oliveira Martins Rocha](https://lucasangelo.com/links)
* [Victor Boaventura Goes Campos](https://github.com/777-victor)

## 👩‍🏫 Professoras responsáveis

* Eveline Alonso Veloso
* Juliana Amaral Baroni de Carvalho

## 🚀 Tecnologias

* [PHP 7.2](https://www.php.net/)
* [Lumen](https://lumen.laravel.com/)
* [MySQL](https://www.mysql.com/)
* [Boostrap 5](https://getbootstrap.com/)

## ⤵ Instruções de utilização

Essas instruções vão te levar a uma cópia do projeto rodando em sua máquina local para propósitos de testes e desenvolvimento.

```bash
- git clone https://github.com/ICEI-PUC-Minas-PPLES-TI/plf-es-2021-1-ti3-6654100-parkio.git
- cd plf-es-2021-1-ti3-6654100-parkio
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

Instalando dependências



## 🔗 Links do projeto

- [Artefatos](Artefatos)
- [Codigo](Codigo)
- [Divulgacao](Divulgacao)
- [Documentacao](Documentacao)

## 📝 Licença

Esse projeto está sob a licença Creative Commons Attribution 4.0 International. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---
