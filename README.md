# Log Parser

### Objetivo do projeto

O objetivo do projeto é desenvolver uma aplicação que leia um .txt no formato [ndjson](http://ndjson.org/), armazernar o conteúdo em banco de dados e então prover esses dados em formato CSV.

##### Considerações

 Conversão do NDJson - Visando performance de uma conversão tão volumosa de dados foram consideradas algumas opções como o pacote [JSONMachine](https://github.com/halaxa/json-machine), mas descartado pois tornava a manipulação dos dados mais trabalhosa não compensando o custo de implementação x o ganho de performance irrisório.

 ##### Estrutura do banco de dados 
 
 Foram testadas duas estruturas de bancos de dados: 
 
 - A primeira estrutura era dividida em services, requests e consumers em tabelas separadas, visando uma normalização da estrutura e evitando repetição de informações;
 
 - A segunda implementação que é a que foi escolhida, que coloca todos os dados em uma única tabela, sendo feita assim por motivos de performance, os dados acabavam levando muito tempo para serem salvos devido a execução de 3 inserts por request (caso o consumer já não tivesse sido cadastrado).

##### Commands:

Já que não houveram exigências quanto a forma que deveriam ser estruturadas cada tarefa, as commands foram feitas separadamente para cada requisito do projeto, visando testabilidade e isolamento das funcionalidades.

##### PSR-2

Foi utilizado o php-cs-fixer com as regras de PSR-2 implementadas visando manter estruturação e padronização dos arquivos, as regras seguidas pelo lint podem ser encontradas em `.php_cs`.

##### PHPUnit

A suite de testes está dividida em `feature` e `unit` como o padrão do framework, as commands estão em feature e as classes criadas no projeto em unit.

Para rodar os testes é preciso copiar o arquivo `phpunit.xml.dist` e renomeá-lo para `phpunit.xml`.

### Rodando o projeto

O projeto está organizado em 4 commands para executar todas features requisitadas pelo teste:

Primeiro é necessário fazer o setup do banco de dados, criando uma base e adicionando as chaves necessárias para a conexão no .env. Feito isso, deve ser rodado o comando `php logger migrate`.

É necessário adicionar o arquivo de logs em `storage/` com o nome logs.txt
  
    php logger parse:file
    
  Essa command fará o parse do arquivo de logs e salvá-los em banco de dados na tabela `requests`.
  
  Para gerar cada um dos requisitos podem ser rodadas as seguintes commands:
    
    // Exporta a média de latencias por serviços
    php logger export:average-duration-per-service

    // Exporta as requests agrupadas por consumer
    export:per-consumer

    // Exporta as requests agrupadas por serviço
    export:per-service
