# Documentação - ParkIO


Guilherme Gabriel Silva Pereira,

José Maurício Guimarães França,

Henrique Penna Forte Monteiro,

Lucas Ângelo Oliveira Martins Rocha,

Victor Boaventura Goes Campos

---

​### Instituto de Informática e Ciências Exatas– Pontifícia Universidade de Minas Gerais (PUC
MINAS)

Belo Horizonte – MG – Brasil

---

**ggspereira@sga.pucminas.br**

**henrique.forte@sga.pucminas.br**

**jmgfranca@sga.pucminas.br**

**laomrocha@sga.pucminas.br**

**vbgcampos@sga.pucminas.br**

---

**_Resumo._**
O ParkIO é uma aplicação web desenvolvida para possibilitar que a portaria do Condomínio do Conjunto Habitacional Santa Terezinha tenha controle da entrada e saída dos veículos visitantes. Essa aplicação é necessária pois o condomínio possui mais de 50 blocos, com isso, a quantidade de visitas por dias é muito alta.
Dessa forma, por meio dessa aplicação, a administração do condomínio consiguirá verificar quais são os veículos que estão a mais tempo dentro do condomínio ocupando as poucas vagas que o estacionamento comunitário oferece.

___ 

**1. Introdução**

**1.1 Contextualização**

O Condomínio do Conjunto Habitacional Santa Terezinha possuí cerca de 918 apartamentos, porém há somente 2 portarias e aproximadamente 800 vagas que são de acesso aos moradores e aos visitantes do condomínio. Considerando os fatos acima, há um empecilho para controlar o fluxo dos veículos de uma maneira ágil e segura.

À todo momento veículos entram e saem do condomínio e o controle de  quanto tempo veículos de visitantes estão dentro do condomínio é difícil de ser realizado. Atualmente há rondas que ajudam neste processo porém o gerenciamento é prejudicado devido ao fluxo de veículos muito alto.

**1.1.1 Pesquisas**

Foi feita uma pesquisa, pelos integrantes José Maurício, Henrique Penna e Victor Boaventura sobre o atual funcionamento de cadastro de entradas de veículos visistantes na portaria do condomínio. Diante disso, foi possível capturar a atual estrutura física de entrada de veículos:

| ![Imagem1](https://i.imgur.com/jqHuvv2.png "Imagem1") |
|:--:| 
| *<sub>Imagem 1 - Portaria do condomínio.</sub>* |

Buscando entender o cadastro de dados dos veículos atualmente foi registrado o documento com informações cadastrais:

| ![Imagem2](https://i.imgur.com/M7AymMi.png "Imagem2") |
|:--:| 
| *<sub>Imagem 2 - Documento de dados do visistante.</sub>* |

Diante disso, foi estudado sobre o tamanho do condomínio e a agilidade que a aplicação deverá oferecer:

| ![Imagem2](https://i.imgur.com/tS0TSrM.jpg "Imagem2") |
|:--:| 
| *<sub>Imagem 3 - Visão geral do condomínio.</sub>* |

**1.2 Problema**

Devido ao fato do Condomínio do Conjunto Habitacional Santa Terezinha possuir 54 blocos de prédios, a entrada de visitantes (familiares, entregadores, prestadores de serviço, etc..), a portaria do condomínio recebe um grande fluxo de visitantes por dia. Com isso, não é possível de fazer o controle manual de todos os visistantes que estão dentro do condomínio.
Além disso, o condomínio possui apenas um estacionamento comunitário, isso, para todos os visitantes de todos os blocos. Logo, isso complica ainda mais o controle de para onde foi cada um dos visisantes. Sendo mais difícil de controlar o tempo que o visitante fica dentro do condomínio ocupando a vaga.
Ademais, o condomínio também possui duas portarias que não se comunicam eletronicamente sobre o fluxo de entrada de visitantes, complementando a dificuldade no controle de entrada e saída dos veículos de visistantes.

**1.3 Objetivo geral**
O objetivo geral da ParkIo é possibilitar um gerenciamento eficaz do fluxo de veículos no estacionamento do Condomínio do Conjunto Habitacional Santa Terezinha> Efetuando assim, um controle ágil e seguro do fluxo de veículos, para que haja uma vivência melhor no Condomínio.

**1.3.1 Objetivos específicos**

● Permitir o cadastro de veículos de visitantes , que disponibilizará um tempo padrão, porém alterável, de residência no estacionamento.

● Permitir o cadastro de veículos de prestadores de serviço, que disponibilizará um tempo maior, porém alterável, de residência no estacionamento.

● Gerar alertas sobre veículos que excederam o tempo de residência para um grupo de telegram contendo os porteiros e rondas.

● Fornecer funcionalidades que permitam a classificação dos visitandes por meio de avaliações realizadas pelo usuário.

___

**2. Participantes do processo**

O Mapa de Stakeholder pode ser acessado de forma dinâmica pelo link: https://miro.com/app/board/o9J_lP2PbLY=/ . Nele foram detectados os principais usuários que utilizaram e/ou foram afetados pela aplicação do ParkIO. Abaixo está anexada uma versão A4 estática do mapa de stakeholder circle.

| ![Imagem4](https://i.imgur.com/dX85ZXT.jpg "Imagem4") |
|:--:| 
| *<sub>Imagem 4 - Mapa de StakeHolders do ParkIO.</sub>* |
___

**3. Projeto da Solução**

**3.1 - Wireframes**
Link para visualização dos wireframes no adobe XD: https://xd.adobe.com/view/717f31eb-109b-42b9-8de2-66d61bce1032-242c/screen/81f73c16-6800-4d69-a21b-f10a0eaa9a1f

**3.2. Requisitos funcionais**

| No.    | Processo/tarefa | Descrição/Informações | Prioridade | Complexidade |
| :----- |:---------------:| :-------: | :--------: | :----------: |
1 | O porteiro deve cadastrar os veículos no sistema. | Informações: Placa, Modelo, Cor, Bloco, Apto de Destino, tempo de permanência, nome do visitante, CPF, tipo de visitante. | Alta | Média
2 | O porteiro deve definir o Status do veículo visitante para 'Saiu' e marcar uma avaliação de como foi comportamento do condutor quando o veículo visitante sair. | Informações: Status, e avaliação (Bom ou Ruim). | Alta | Média
3 | O administrador do sistema deve cadastrar tipos de visitantes. | (Ex: Entrega dos Correios, Técnico de Banda Larga, etc...), e definir um tempo recomendado que o visitante fique dentro do condomínio. | Alta | Baixa
4 | O porteiro poderá aumentar o tempo de permanência do visitante. | Após fazer contato com o morador para verificar o motivo do atraso. O adiamento necessita de uma justificativa redigida pelo porteiro. | Baixa | Média
5 | O sistema deve emitir um alerta para um grupo no Telegram contendo os porteiros e os rondas. | No caso de algum veículo ficar determinado tempo dentro do condomínio. Informações: O tempo padrão máximo para veículos de visitantes é de 20 minutos para sair, e o tempo padrão máximo para veículos de prestadores de serviço é de 8 horas para sair, podendo ser alterado pela administração do condomínio. | Alta | Alta
6 | O administrador do sistema poderá criar usuários com diferentes permissões. | Para que por exemplo, um sindico não possa alterar que um veículo saiu, apenas porteiros. | Média | Alta
7 | O administrador do sistema poderá criar diferentes portarias dentro do sistema. | Pois o condomínio tem mais de uma portaria. | Média | Baixa
8 | Os usuários de qualquer tipo devem ser capazes de fazer login. | Para que consigam acessar o sistema. | Alta | Baixa
9 | Os usuários de qualquer tipo devem selecionar uma portaria para utilizar o sistema. | Pois um porteiro, por exemplo, pode trabalhar nas duas portarias, porém, estar em apenas uma de cada. | Média | Média
10 | Os usuários devem poder consultar a lista de veículos. | Isso deve ser possível para fins de monitoramento por parte dos usuários. | Baixa | Média
11 | A administração deverá possuir um relatório delimitado por um filtro de período de tempo, porteiro e/ou placa do veículo. | Informações: O relatório irá conter todas as informações que foram cadastradas na entrada de cada veículo e a quantidade de veículos visitantes cadastradas. | Baixa | Alta
12 | O porteiro deverá escrever o motivo do bloqueio de um veículo visitante, caso ocorra algum problema com a visita. | Caso algum veículo reportado volte a tentar entrar no estacionamento, deve aparecer um aviso de bloqueio. | Média | Média
13 | O ronda poderá editar certas informações do veículo do visitante. | Informações: Placa, Modelo e Cor. | Baixa | Baixa

**3.4 - Diagrama de Caso de Uso**
| ![Imagem5](https://i.imgur.com/Xx9pRcY.jpg "Imagem5") |
|:--:| 
| *<sub>Imagem 5 - Diagrama de Caso de Uso ParkIO.</sub>* |

**3.5 - Diagrama de Caso de Classes**
| ![Imagem6](https://i.imgur.com/vu6QIbI.jpg "Imagem6") |
|:--:| 
| *<sub>Imagem 6 - Diagrama de Caso de Classes ParkIO.</sub>* |

**3.6 - Diagrama de Entidade-Relacionamento**
| ![Imagem7](https://i.imgur.com/idH7I0wh.jpg "Imagem7") |
|:--:| 
| *<sub>Imagem 7 - Diagrama de Entidade e Relacionamento ParkIO.</sub>* |

***3.8. Tecnologias***
Será desenvolvida uma aplicação web, diante disso, é necessário definir linguagens de marcação, estilização, de programação e um sistema de gerenciamento de banco de dados para suprir toda essa aplicação do ParkIO. Os wireframes foram desenvolvidos utilizando o programa Adobe XD. Como linguagem de marcação de hipertexto foi escolhido o HTML5 para construção estrutural do site, para estilização utilizaremos CSS3, com auxílio do framework Bootstrap 4.6. Para programação será utilizado JavaScript no frontend e no backend PHP com auxílio do framework Lumen, e o SGBD selecionado foi o MySQL por ser relacional e gratuito. A IDE de desenvolvimento escolhida foi o Visual Studio Code. A empresa de hospedagem para a aplicação foi escolhida a SanInternet.com, para hospedar a aplicação. A hospedagem utilizada será com o gerencimento da ferramenta cPanel.
- Diante disso, as tecnologias definidas foram: 
    - HTML, CSS, JavaScript e Bootstrap para o Frontend.
    - PHP e Lumen para o Backend.
    - MySQL como SGBD.
    - Adobe XD para criação de wireframes.
    - Saninternet como nuvem de hospedagem.
    - Cpanel como ferramenta de administração da hospedagem.
    - Miro para criação do artefato de Stakeholder map.
    - MySQL Workbench para criar o modelo lógico EER de SQL (Implementação do modelo de Entidade e Relacionamento).
    - Markdown para documentação e textos no Github.
    - IDE Visual Studio Code.
    - Servidor Apache e MySQL local Wamp ou XAMPP para desenvolvimento.

| ![Imagem8](https://i.imgur.com/mYCFwLB.png "Imagem8") |
|:--:| 
| *<sub>Imagem 8 - Interações entre usuário e tecnologia.</sub>* |

***4. Uso Software***


***5. Avaliação***


***6. Conclusão***


**APÊNDICES**

Código: <https://github.com/ICEI-PUC-Minas-PPLES-TI/plf-es-2021-1-ti3-6654100-parkio/tree/master/Codigo>

Artefatos: <https://github.com/ICEI-PUC-Minas-PPLES-TI/plf-es-2021-1-ti3-6654100-parkio/tree/master/Artefatos>
