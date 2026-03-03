# LeoClube - Projeto Laravel

Projeto Laravel com conexão MySQL configurada.

## Requisitos

- PHP >= 8.1
- Composer
- MySQL >= 5.7 ou MariaDB >= 10.3
- Extensões PHP: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML

## Instalação

### 1. Instalar dependências

```bash
composer install
```

### 2. Configurar ambiente

Copie o arquivo `.env.example` para `.env` (já criado) e configure as variáveis de ambiente:

```bash
# Configurações do Banco de Dados MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=leoclube
DB_USERNAME=root
DB_PASSWORD=sua_senha_aqui
```

### 3. Gerar chave da aplicação

```bash
php artisan key:generate
```

### 4. Criar o banco de dados MySQL

Acesse o MySQL e crie o banco de dados:

```sql
CREATE DATABASE leoclube CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Executar migrations

```bash
php artisan migrate
```

### 6. Iniciar servidor de desenvolvimento

```bash
php artisan serve
```

O aplicativo estará disponível em `http://localhost:8000`

## Estrutura do Projeto

```
leoclube/
├── app/                 # Código da aplicação
├── bootstrap/           # Arquivos de inicialização
├── config/              # Arquivos de configuração
├── database/            # Migrations, seeders e factories
├── public/              # Ponto de entrada público
├── resources/           # Views, assets não compilados
├── routes/              # Rotas da aplicação
├── storage/             # Arquivos de armazenamento
├── tests/               # Testes automatizados
└── vendor/              # Dependências do Composer
```

## Configuração do Banco de Dados

O projeto está configurado para usar MySQL como banco de dados padrão. As configurações estão no arquivo `.env`:

- **DB_CONNECTION**: mysql
- **DB_HOST**: 127.0.0.1 (ou seu host MySQL)
- **DB_PORT**: 3306 (porta padrão do MySQL)
- **DB_DATABASE**: leoclube
- **DB_USERNAME**: seu usuário MySQL
- **DB_PASSWORD**: sua senha MySQL

## Comandos Úteis

```bash
# Criar um novo controller
php artisan make:controller NomeController

# Criar uma migration
php artisan make:migration create_nome_tabela_table

# Criar um model
php artisan make:model NomeModel

# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Executar testes
php artisan test
```

## Licença

MIT
