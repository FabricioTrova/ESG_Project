

## License

🛠 Passo a Passo para Instalar e Usar Laravel

1. Instalar o Composer (Gerenciador de pacotes do PHP)
O Laravel depende do Composer para instalar as dependências.

Acesse: https://getcomposer.org/download/

Baixe e instale.

Depois de instalar, abra o terminal (Prompt de Comando / Powershell / Terminal) e digite:

Copie o codigo no prompt:

composer --version
✅ Se aparecer a versão, está instalado!

2. Verificar se o PHP já está instalado
Laravel precisa de PHP 8.0 ou superior.

No terminal, digite:

bash
Copiar
Editar
php --version
✅ Se aparecer a versão do PHP, ótimo.

❗ Se não tiver o PHP, você pode instalar o XAMPP, Laragon ou apenas o PHP separadamente.

3. Instalar o Laravel
Você pode instalar de duas formas:

Forma 1: Usar o instalador global do Laravel (mais rápido)

Copie o codigo no prompt:
composer global require laravel/installer
Depois, você pode criar projetos assim:

Copie o codigo no prompt:
laravel new nome-do-projeto

Exemplo:
laravel new meu-site
Forma 2: Criar projeto via Composer diretamente
(Sem precisar instalar o instalador)

Copie o codigo no prompt:

composer create-project laravel/laravel nome-do-projeto
Exemplo:

Copie o codigo no prompt:

composer create-project laravel/laravel meu-site
🚀 Essa forma é a mais comum hoje em dia.

4. Acessar o projeto
Entre na pasta do projeto:

Copie o codigo no prompt:
cd meu-site
5. Rodar o servidor embutido do Laravel
Laravel já vem com um servidor interno para testar localmente!

No terminal, dentro do projeto, digite:

Copie o codigo no prompt:

php artisan serve
Isso vai rodar o projeto localmente, e ele vai te mostrar algo como:


Copie o codigo no prompt:

Starting Laravel development server: http://127.0.0.1:8000
✅ Acesse no navegador: http://127.0.0.1:8000 ou http://localhost:8000


Pasta/Arquivo	O que é
/routes/web.php	Arquivo onde você define as rotas (URLs) do site
/app/Http/Controllers/	Onde ficam seus controllers
/resources/views/	Onde ficam as views (telas HTML)
/app/Models/	Onde ficam os models (opcionalmente criados)
/public/	Pasta pública (imagens, css, js, etc)
📌 Exemplo básico de código
Editar uma rota em routes/web.php:

