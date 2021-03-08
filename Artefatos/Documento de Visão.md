
# Documento de Visão
----------------------------------------------------------------------------------------------------------------
#### Nome do Projeto: ParkIO.
----------------------------------------------------------------------------------------------------------------
#### Autores: Guilherme Gabriel, Henrique Penna, José Maurício, Lucas Ângelo e Victor Boaventura. 
----------------------------------------------------------------------------------------------------------------
#### Fornecedor(es) de Requisitos

Nome | E-mail | Cargo ou Função – Empresa 
:-:|:-:|:-:
Jonathan|jonathandenisio031@gmail.com|Responsável pelo setor de TI do condomínio. 
Leandro|leandro.parreiras@gmail.com|Síndico do bloco 34.|

### Descrição do Problema 
----------------------------------------------------------------------------------------------------------------
O Condomínio do Conjunto Habitacional Santa Terezinha possui cinquenta e quatro blocos e duas portarias, com isso, é difícil de controlar a entrada de todos os visitantes, além de não existir um estacionamento para cada bloco, dificultando ainda mais o controle de veículos dos visitantes. Diante disso, o condomínio possui uma demanda de segurança envolvendo o controle da entrada e saída de veículos de não condôminos. 

### Descrição Geral da Solução (Escopo) 
----------------------------------------------------------------------------------------------------------------
Desenvolver um sistema/aplicação web que consiga controlar a entrada e saída dos veículos nos diversos blocos do conjunto. Possibilitando assim, a portaria e a administração saberem quanto tempo estão dentro do condomínio e para onde foi cada um dos veículos visitantes. 

### Fora do Escopo 
----------------------------------------------------------------------------------------------------------------
Se possível, estudar o funcionamento atual de segurança. 

### Usuários 
----------------------------------------------------------------------------------------------------------------
* A administração do condomínio, terão as permissões de visualizar, cadastrar, alterar e remover veículos, além de poder criar usuários, visualizar os relatórios e alterar configurações do sistema. 

* Síndicos(as) de cada bloco, terá a permissão de visualizar somente os carros direcionados ao seu bloco, sem poder fazer alterações no registro. 

* Porteiros(as), terão as permissões de cadastrar a entrada e saída dos veículos para sua portaria que está instante, e enviar alertas para administração (Caso seja necessário um veículo visitante ficar mais tempo). 

* Rondas, acesso para apenas visualizar todos os carros visitantes. 

### Requisitos Funcionais 

ID | Descrição do Requisito | Prioridade | Complexidade 
:-:|:-:|:-:|:-:
1 | O porteiro cadastra os veículos no sistema. Informações: Placa, Modelo, Cor, Bloco, Apto de Destino, Status, Horário de Chegada e Classificação (Se trata um visitante ou um prestador de serviço). | Alta | Média 
2 | O sistema deve marcar o campo de Status como 'Dentro' a cada cadastro de veículos. | Alta | Baixa
3 | O sistema deve gerar automaticamente o campo de Horário de Chegada para cada cadastro de veículos. | Alta | Baixa
4 | O sistema deve disponibilizar uma configuração padrão de campos para visitantes e prestadores de serviço. | Alta | Média
2 | O porteiro altera o campo Status do veículo visitante para removido. Informações: Status, horário de saída (Automaticamente) e avaliação (Bom ou Ruim). | Alta | Média 
3 | A aplicação deve emitir um alerta integrado ao Telegram caso algum veículo ficar determinado tempo dentro do condomínio. Informações: O tempo padrão máximo para veículos de visitantes é de 20 minutos para sair, e o tempo padrão máximo para veículos de prestadores de serviço é de 8 horas para sair. | Alta | Alta 
4 | O administrador da aplicação poderá criar usuários com diferentes permissões. | Média | Alta 
5 | A aplicação deverá registrar as ações de cada usuário responsável pelos RF-1 (Requisito Funcional 1) e RF-2 (Requisito Funcional 2). | Média | Média 
6 | A aplicação deve atualizar dados a lista de cadastros de veículos visitantes automaticamente a cada trinta segundos. | Baixa | Média 
7 | A aplicação deverá possuir um relatório delimitado por um filtro de período de tempo, porteiro e/ou placa do carro, determinado pelo usuário administrador. Informações: O relatório irá conter todas as informações que foram cadastradas na entrada de cada veículo e a quantidade de veículos visitantes cadastradas. | Baixa | Alta 

### Requisitos Não Funcionais 

ID | Descrição do Requisito | Prioridade | Complexidade 
:-:|:-:|:-:|:-:
1 | A aplicação web deve ser responsiva para proporcionar o uso de todas as funcionalidades providas pelos requisitos funcionais em resoluções de 576px até 1080px. | Alta | Média 
2 | A aplicação deve processar requisições do usuário em no máximo 3 segundos. | Alta | Baixa
3 | A aplicação deve ser aprovada nos testes unitários de requisições HTTP e autenticação. | Alta | Alta 
4 | A aplicação deve possuir uma interface web que seja objetiva para o usuário, com no máximo três funcionalidades por página. | Alta | Média
5 | A aplicação deve ser compatível com sistema operacional Linux, com o objetivo de proporcionar a disponibilidade em nuvem de pelo menos 98% do tempo de atividade (uptime). | Alta | Baixa 
6 | A aplicação deve ser dimensionada para suportar até 20 usuários conectados ao mesmo tempo. | Média |Baixa 
7 | A aplicação deve garantir a segurança das senhas dos usuários, criptografando-as ao serem inseridas no banco de dados. | Alta | Baixa 
8 | A aplicação deve garantir a integridade do registro simultâneo de veículos por mais de um usuário ao mesmo tempo, por meio do padrão de Int com auto increment como chave primária na tabela do banco de dado que recebe os veículos visitantes cadastrados. | Média | Baixa 

### Técnica(s) de Elicitação utilizada(s) 

Entrevista com o resposável pelo setor de TI do condomínio, juntamente com um síndico do bloco 34. Além disso, uma visita no condomínio para entender o funcionamento atual da entrada de veículos.
Ademais, o uso do documento de cadastro de dados de entrada de veículos, para estudar os campos utilizados ao identificar um veículo no controle de entrada e saída.