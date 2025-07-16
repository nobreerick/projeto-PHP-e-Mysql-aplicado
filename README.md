# projeto-PHP-e-Mysql-aplicado
Projeto adaptado do projeto guia do curso de PHP e MYSQL para WEB da plataforma ALURA.

Premissa:
- Site Web do empreendimento Serenatto Café, que implementa um cardápio online, tela de login, área de administrador, e gerenciamento de produtos.

Como usar esse repositório:

1- Edite o arquivo .env-template, adicionando informações personalizadas ao seu propósito;

2- Renomei o arquivo .env-template para .env

3- Rodar o script "rodarPho.sh" ou usar os comandos desse arquivo individualmente para levantar os containers;

3.1- atenção: foram reservadas as portas 8001, 8080 e 3309 para esse projeto, importante verificar se não existem conflitos delas com outros projetos ou aplicações. Caso haja, alterar o arquivo "docker-comose.yml" na seção ports do container "bd" e "php";

4- Rodar pelo container do PHP o comando "php -S localhost:8080" isso criará uma instância de um servidor web do projeto, e tornará acessível de um navegador do host o acesso à aplicação pelo endereço localhost:8080



Pontos interessantes aplicado até o momento nesse exercício:
- utilização de containers para rodar o projeto;
- utilização de variáveis de ambiente para proteger dados sensiveis de produção;
- utilização do PHP composer para gerenciar dependências e instanciar o arquivo de autoload;
- Frontend html, css e assests -> apenas para ilustar (fornecido pela plataforma ALURA);
- utilização do desing pattern Data Access Object (DAO);
- utilização de estrutura de pastas e convençoes da PSR-4 do PHP;
- tentativa de utilização dos princípios do Object Calisthenics na escrita do código;
- construção dos testes unitários para grande parte das funções e métodos;
- Contexto replicável em qualquer situação:
    - Página inicial dinâmica;
    - Página de Login funcional;
    - Página de administração;
    - Páginas de ação;

Pontos que poderão ser aplicados:
- Integração com alguma ferramenta Linter (possívelmente PHP_CodeSniffer) para estilização de código e criação de dependência de desenvolvimento;
- Integração com PHPUnit para iniciar processo de Continuos Integration na área de testes automatizados;

