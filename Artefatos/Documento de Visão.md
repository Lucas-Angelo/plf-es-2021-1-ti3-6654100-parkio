
# Documento de Visão
----------------------------------------------------------------------------------------------------------------
#### Nome do Projeto: ParkIO.
----------------------------------------------------------------------------------------------------------------
#### Autores: Guilherme Gabriel Silva Pereira, Henrique Penna Forte Monteiro, José Maurício Guimarães França, Lucas Ângelo Oliveira Martins Rocha e Victor Boaventura Goés Campos.
----------------------------------------------------------------------------------------------------------------
#### Fornecedor(es) de Requisitos

|      Nome     |               E-mai              |                 Cargo ou Função – Empresa            |
|:-------------:|:--------------------------------:|:----------------------------------------------------:|
|    Jonathan   |   jonathandenisio031@gmail.com   |     Responsável pelo setor de TI do condomínio.      |
|    Leandro    |   leandro.parreiras@gmail.com    |     Responsável pelo setor financeiro do condomínio. |

### Descrição do Problema
----------------------------------------------------------------------------------------------------------------
O Condomínio do Conjunto Habitacional Santa Terezinha tem cinquenta e quatro blocos e duas portarias, além de não possuir um estacionamento exclusivo para cada apartamento. Com isso, é difícil de controlar a entrada e saída dos visitantes, dificultando a portaria de fazer o controle de veículos de visitantes. Diante disso, o condomínio possui uma demanda de segurança envolvendo o controle da entrada e saída de veículos que não possuem tag de entrada.

### Descrição Geral da Solução (Escopo)
----------------------------------------------------------------------------------------------------------------
Desenvolver um sistema web que consiga controlar a entrada e saída dos veículos nos diversos blocos do conjunto. Possibilitando assim, a portaria e a administração saberem quanto tempo estão dentro do condomínio e para onde foi cada um dos veículos de visitantes e prestadores de serviço.

### Fora do Escopo
----------------------------------------------------------------------------------------------------------------
- A comunicação entre o porteiro e o morador não será realizada dentro do sistema, será via telefone ou interfone do condomínio.

### Usuários
----------------------------------------------------------------------------------------------------------------
* A administração do condomínio, terá as permissões de visualizar, cadastrar, alterar e remover veículos, além de poder criar usuários, visualizar os relatórios e alterar configurações do sistema.

* Síndicos(as) de cada bloco, terá a permissão de visualizar somente os veículos direcionados ao seu bloco, sem poder fazer alterações no registro.

* Porteiros(as), terão as permissões de cadastrar a entrada e saída dos veículos para sua portaria que está instante, e enviar alertas para administração (Caso seja necessário um veículo visitante ficar mais tempo).

* Rondas, acesso para visualizar e alterar dados de todos os veículos visitantes.

### Requisitos Funcionais

ID | Descrição do Requisito | Prioridade | Complexidade
:-:|:-:|:-:|:-:
1 | O porteiro deve cadastrar os veículos no sistema.| Alta | Média
2 | O porteiro deve definir o Status do veículo visitante para 'Saiu' e marcar uma avaliação de como foi comportamento do condutor quando o veículo visitante sair. | Alta | Média
3 | O administrador do sistema deve cadastrar tipos de visitantes (Ex: Entrega dos Correios, Técnico de Banda Larga, etc...), e definir um tempo recomendado que o visitante fique dentro do condomínio. | Alta | Baixa
4 | O porteiro poderá aumentar o tempo de permanência do visitante após fazer contato com o morador para verificar o motivo do atraso. | Baixa | Média
5 | O sistema deve emitir um alerta para um grupo no Telegram contendo os porteiros e os rondas no caso de algum veículo ficar determinado tempo dentro do condomínio. | Alta | Alta
6 | O administrador do sistema poderá criar usuários com diferentes permissões. | Média | Alta
7 | O administrador do sistema poderá criar diferentes portarias dentro do sistema. | Média | Baixa
8 | Os usuários de qualquer tipo devem ser capazes de fazer login. | Média | Média
9 | Os usuários de qualquer tipo devem selecionar uma portaria para utilizar o sistema. | Média | Média
10 | Os usuários devem poder consultar a lista de veículos. | Baixa | Média
11 | A administração deverá possuir um relatório delimitado por um filtro de período de tempo, porteiro e/ou placa do veículo. | Baixa | Alta
12 | O porteiro deverá escrever o motivo do bloqueio de um veículo visitante, caso ocorra algum problema com a visita. | Média | Média
13 | O ronda poderá editar certas informações do veículo do visitante. | Baixa | Baixa

### Requisitos Não Funcionais

ID | Descrição do Requisito | Prioridade | Complexidade
:-:|:-:|:-:|:-:
1 | O sistema web deve ser responsiva para proporcionar o uso de todas as funcionalidades providas pelos requisitos funcionais em resoluções de 576px até 1080px. | Alta | Média
2 | O sistema deve processar requisições do usuário em no máximo 3 segundos. | Alta | Baixa
3 | O sistema deve ser aprovada nos testes unitários de requisições HTTP e autenticação. | Alta | Alta
4 | O sistema deve possuir uma interface web que seja objetiva para o usuário, com no máximo três funcionalidades por página. | Alta | Média
5 | O sistema deve ser compatível com sistema operacional Linux, com o objetivo de proporcionar a disponibilidade em nuvem de pelo menos 98% do tempo de atividade (uptime). | Alta | Baixa
6 | O sistema deve ser dimensionada para suportar até 20 usuários conectados ao mesmo tempo. | Média |Baixa
7 | O sistema deve garantir a segurança das senhas dos usuários, criptografando-as ao serem inseridas no banco de dados. | Alta | Baixa
8 | O sistema deve garantir a integridade do registro simultâneo de veículos por mais de um usuário ao mesmo tempo, por meio do padrão de Int com auto increment como chave primária na tabela do banco de dado que recebe os veículos visitantes cadastrados. | Média | Baixa

### Técnica(s) de Elicitação utilizada(s)

Entrevista com o resposável pelo setor de TI do condomínio, juntamente com o resposável pelo setor financeiro. Além disso, uma visita no condomínio para entender o funcionamento atual da entrada de veículos.
Ademais, o uso do documento de cadastro de dados de entrada de veículos, para estudar os campos utilizados ao identificar um veículo no controle de entrada e saída.
