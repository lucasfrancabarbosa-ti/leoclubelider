# 📦 Guia de Instalação - LeoClube Laravel

Este guia irá ajudá-lo a configurar o projeto Laravel com MySQL do zero.

## 🔧 Pré-requisitos

Antes de começar, certifique-se de ter instalado:

1. **PHP >= 8.1** com as seguintes extensões:
   - BCMath
   - Ctype
   - Fileinfo
   - JSON
   - Mbstring
   - OpenSSL
   - PDO
   - Tokenizer
   - XML

2. **Composer** - Gerenciador de dependências PHP
   - Download: https://getcomposer.org/download/
   - Ou instale via: `php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"`

3. **MySQL >= 5.7** ou **MariaDB >= 10.3**
   - Certifique-se de que o serviço MySQL está rodando

## 🚀 Passo a Passo

### 1. Instalar o Composer (se ainda não tiver)

**Windows:**
```powershell
# Baixe o instalador do Composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"

# Mova o composer.phar para um diretório no PATH ou use diretamente
php composer.phar install
```

**Ou instale globalmente:**
- Baixe o instalador: https://getcomposer.org/Composer-Setup.exe
- Execute e siga as instruções

### 2. Instalar Dependências do Projeto

No diretório do projeto, execute:

```bash
composer install
```

Ou se o Composer não estiver no PATH:

```bash
php composer.phar install
```

### 3. Configurar o Arquivo .env

O arquivo `.env` já foi criado. Edite-o e configure suas credenciais do MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=leoclube
DB_USERNAME=seu_usuario_mysql
DB_PASSWORD=sua_senha_mysql
```

### 4. Gerar Chave da Aplicação

```bash
php artisan key:generate
```

Isso irá gerar uma chave única e adicioná-la ao arquivo `.env`.

### 5. Criar o Banco de Dados MySQL

Acesse o MySQL via linha de comando ou cliente gráfico (phpMyAdmin, MySQL Workbench, etc.):

```sql
CREATE DATABASE leoclube CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Ou via linha de comando:

```bash
mysql -u root -p
```

Depois execute:
```sql
CREATE DATABASE leoclube CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 6. Executar Migrations

```bash
php artisan migrate
```

Isso criará as tabelas necessárias no banco de dados.

### 7. Criar Tabela de Sessões (se usar driver database)

Se você configurou `SESSION_DRIVER=database` no `.env`, execute:

```bash
php artisan session:table
php artisan migrate
```

### 8. Iniciar o Servidor de Desenvolvimento

```bash
php artisan serve
```

O aplicativo estará disponível em: **http://localhost:8000**

## ✅ Verificação

Após seguir todos os passos, você deve conseguir:

1. Acessar `http://localhost:8000` e ver a página de boas-vindas
2. Verificar a conexão com o banco de dados executando:
   ```bash
   php artisan tinker
   ```
   E depois:
   ```php
   DB::connection()->getPdo();
   ```
   Se retornar informações do PDO, a conexão está funcionando!

## 🐛 Solução de Problemas

### Erro: "Class 'PDO' not found"
- Instale a extensão PDO do PHP
- No Windows, edite o `php.ini` e descomente: `extension=pdo_mysql`

### Erro: "Access denied for user"
- Verifique as credenciais no arquivo `.env`
- Certifique-se de que o usuário MySQL tem permissões para acessar o banco

### Erro: "Unknown database 'leoclube'"
- Crie o banco de dados seguindo o passo 5

### Composer não encontrado
- Instale o Composer seguindo o passo 1
- Ou use `php composer.phar` em vez de `composer`

## 📚 Próximos Passos

Agora que o projeto está configurado, você pode:

- Criar controllers: `php artisan make:controller NomeController`
- Criar models: `php artisan make:model NomeModel`
- Criar migrations: `php artisan make:migration create_nome_tabela_table`
- Criar seeders: `php artisan make:seeder NomeSeeder`

Boa sorte com o desenvolvimento! 🎉
