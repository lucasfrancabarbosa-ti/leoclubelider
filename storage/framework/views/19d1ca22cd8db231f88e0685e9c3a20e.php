<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LeoClube - Laravel</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #333;
            }
            .container {
                background: white;
                border-radius: 20px;
                padding: 3rem;
                box-shadow: 0 20px 60px rgba(0,0,0,0.3);
                text-align: center;
                max-width: 600px;
            }
            h1 {
                color: #667eea;
                margin-bottom: 1rem;
                font-size: 2.5rem;
            }
            .subtitle {
                color: #666;
                margin-bottom: 2rem;
                font-size: 1.2rem;
            }
            .status {
                background: #f0f9ff;
                border-left: 4px solid #667eea;
                padding: 1rem;
                margin: 1.5rem 0;
                border-radius: 5px;
                text-align: left;
            }
            .status-title {
                font-weight: bold;
                color: #667eea;
                margin-bottom: 0.5rem;
            }
            .info {
                color: #555;
                line-height: 1.6;
            }
            .version {
                margin-top: 2rem;
                color: #999;
                font-size: 0.9rem;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>🚀 LeoClube</h1>
            <p class="subtitle">Projeto Laravel configurado com sucesso!</p>
            
            <div class="status">
                <div class="status-title">✅ Status do Projeto:</div>
                <div class="info">
                    <p><strong>Framework:</strong> Laravel <?php echo e(app()->version()); ?></p>
                    <p><strong>Ambiente:</strong> <?php echo e(app()->environment()); ?></p>
                    <p><strong>Banco de Dados:</strong> MySQL (configurado)</p>
                    <p><strong>Locale:</strong> <?php echo e(app()->getLocale()); ?></p>
                </div>
            </div>

            <div class="status">
                <div class="status-title">📋 Próximos Passos:</div>
                <div class="info">
                    <p>1. Execute <code>composer install</code> para instalar as dependências</p>
                    <p>2. Configure o arquivo <code>.env</code> com suas credenciais do MySQL</p>
                    <p>3. Execute <code>php artisan key:generate</code> para gerar a chave da aplicação</p>
                    <p>4. Crie o banco de dados MySQL: <code>CREATE DATABASE leoclube;</code></p>
                    <p>5. Execute <code>php artisan migrate</code> para criar as tabelas</p>
                </div>
            </div>

            <div class="version">
                Laravel v<?php echo e(app()->version()); ?> | PHP v<?php echo e(PHP_VERSION); ?>

            </div>
        </div>
    </body>
</html>
<?php /**PATH /var/www/html/resources/views/welcome.blade.php ENDPATH**/ ?>