# Registro de Jogadores CODM

Este repositório contém uma aplicação web simples para registrar jogadores do jogo Call of Duty: Mobile (CODM) com seus respectivos UIDs e nomes.

## Funcionalidades

- Registro de jogadores com UID e nome.
- Verificação de se um UID já está registrado.

## Tecnologias Utilizadas

- HTML
- CSS
- PHP
- MySQL (XAMPP para o ambiente de desenvolvimento)

## Pré-requisitos

- Ter o XAMPP instalado e em execução no seu computador.
- Criar um banco de dados MySQL chamado `cod_teams`.
- Criar uma tabela `jogadores` com os seguintes campos:
    - `id` (INT, Auto Increment, Primary Key)
    - `uid` (VARCHAR)
    - `nome` (VARCHAR)

## Como Usar

1. Clone o repositório ou baixe os arquivos.
2. Coloque os arquivos na pasta `htdocs` do seu XAMPP.
3. Inicie o XAMPP e certifique-se que o servidor Apache e o MySQL estão em execução.
4. Acesse o arquivo `index.html` no seu navegador:
5. Preencha os campos para registrar novos jogadores.

## Contribuições

Sinta-se à vontade para contribuir com melhorias ou correções. 

## Licença

Este projeto é de código aberto e pode ser utilizado e modificado de acordo com a [licença MIT](LICENSE).
