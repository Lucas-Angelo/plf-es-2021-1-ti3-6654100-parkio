
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

| No.    | Processo/tarefa | Descrição/Informações | Prioridade | Complexidade |
| :----- |:---------------:| :-------: | :--------: | :----------: |
1 | O porteiro deve cadastrar os veículos no sistema. | Informações: Placa, Modelo, Cor, Bloco, Apto de Destino, tempo de permanência, nome do visitante, CPF, tipo de visitante. | Alta | Média
2 | O porteiro deve remover o veículo quando o visitante sair. | Informações: Status, e avaliação (Bom ou Ruim). | Alta | Média
3 | O administrador do sistema deve cadastrar tipos de visitantes. | (Ex: Entrega dos Correios, Técnico de Banda Larga, etc...), e definir um tempo recomendado que o visitante fique dentro do condomínio. | Alta | Baixa
4 | O porteiro poderá aumentar o tempo de permanência do visitante. | Após fazer contato com o morador para verificar o motivo do atraso. O adiamento necessita de uma justificativa redigida pelo porteiro. | Baixa | Média
5 | O sistema deve emitir um alerta para um grupo no Telegram quando algum veículo ultrapassar o tempo máximo no condomínio. | No caso de algum veículo ficar determinado tempo dentro do condomínio. Informações: O tempo padrão máximo para veículos de visitantes é de 20 minutos para sair, e o tempo padrão máximo para veículos de prestadores de serviço é de 8 horas para sair, podendo ser alterado pela administração do condomínio. | Alta | Alta
6 | O administrador do sistema poderá criar usuários com diferentes permissões. | Para que por exemplo, um sindico não possa alterar que um veículo saiu, apenas porteiros. | Média | Alta
7 | O administrador do sistema poderá criar diferentes portarias dentro do sistema. | Pois o condomínio tem mais de uma portaria. | Média | Baixa
8 | Os usuários de qualquer tipo devem ser capazes de fazer login. | Para que consigam acessar o sistema. | Alta | Baixa
9 | Os usuários de qualquer tipo devem selecionar uma portaria para utilizar o sistema. | Pois um porteiro, por exemplo, pode trabalhar nas duas portarias, porém, estar em apenas uma de cada. | Média | Média
10 | Os usuários devem poder consultar a lista de veículos. | Isso deve ser possível para fins de monitoramento por parte dos usuários. | Baixa | Média
11 | A administração deverá possuir um relatório delimitado por um filtro de período de tempo, porteiro e/ou placa do veículo. | Informações: O relatório irá conter todas as informações que foram cadastradas na entrada de cada veículo e a quantidade de veículos visitantes cadastradas. | Baixa | Alta
12 | O porteiro deverá reportar um veículo visitante, caso ocorra algum problema. | Caso algum veículo reportado volte a tentar entrar no estacionamento, deve aparecer um aviso de bloqueio. | Média | Média
13 | O ronda poderá editar a cor, a placa e o modelo do veículo visitante. | Informações: Placa, Modelo e Cor. | Baixa | Baixa
14 | O síndico poderá visualizar os veículos designados para o seu bloco. | Média | Baixa

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
