# Portal Inclusão Lúdica

## Sobre o Projeto
O Portal Inclusão Lúdica é uma plataforma digital desenvolvida para o acompanhamento da rotina e dos cuidados diários da população idosa. O sistema tem como objetivo auxiliar idosos, familiares e cuidadores na organização de medicamentos, consultas e atividades do dia a dia, além de disponibilizar informações sobre direitos, benefícios e serviços destinados à terceira idade, promovendo autonomia, qualidade de vida e inclusão digital.

## Integrantes do Grupo
* Adylla Bião Meira Viana
* Ana Luísa Alves Souza
* Brenda Karoline Pereira Tibo
* Max Pereira Rocha

---

## Divisão de Tarefas do Projeto

### Adylla
* Criar e commitar o arquivo README.md na raiz do projeto.
* Criar a classe base e os métodos do CRUD no Model `app/models/Usuario.php`.
* Criar o Controller `app/Controllers/UsuarioController.php`.
* Criar o validador `app/validators/UsuarioValidator.php`.
* Criar as views da pasta `app/views/usuarios/` (`index.php`, `form.php` e `edit.php`).

### Max
* Configuração do repositório no GitHub.
* Manter arquivos de rota e acesso (`.htaccess`, `.gitignore`, `public/.htaccess`, `public/index.php`).
* Manter o arquivo `app/helpers.php` (funções auxiliares).
* Criar Model, Controller, Validator e Views do módulo **Consulta** (`Consulta.php`, `ConsultaController.php`, `ConsultaValidator.php` e views).

### Brenda
* Atualizar o arquivo de configuração de banco de dados (`config/database.example.php`).
* Substituir o script SQL do banco de dados (`database/database.sql`) com as 5 tabelas do grupo.
* Manter o arquivo `app/models/Database.php`.
* Criar Models, Controllers, Validators e Views dos módulos **Medicamento** e **Refeicao**.

### Ana Luísa
* Atualizar estilos CSS em `public/css/estilo.css` com foco em acessibilidade para idosos.
* Manter arquivos JavaScript (`public/js/app.js`) e imagens (`public/img/logo.png`).
* Atualizar o layout principal `app/views/layouts/main.php` com Bootstrap 5 e menu de navegação.
* Criar Model, Controller, Validator e Views do módulo **Exercício** (`Exercicio.php`, `ExercicioController.php`, `ExercicioValidator.php` e views).

---

## Passo a Passo de Execução

1. Configuração Inicial do Banco de Dados e Ambiente:
   * Configurar os arquivos de conexão com o banco de dados conforme o padrão do projeto.
   * Importar o script SQL contendo as 5 tabelas do sistema.

2. Estrutura MVC (Model-View-Controller):
   * Models: Responsáveis pela comunicação com o banco de dados e regras de negócio.
   * Controllers: Controlam o fluxo das requisições e a exibição das telas.
   * Validators: Validam os campos de entrada dos formulários.
   * Views: Interfaces visuais adaptadas para acessibilidade.

3. Controle de Versão (Git / GitHub):
   * Realizar commits padronizados e descritivos para cada alteração no código.