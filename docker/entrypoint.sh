#!/bin/sh
set -e

cat > /var/www/html/config/app_local.php << 'PHPEOF'
<?php
return [
    'debug' => true,
    'Security' => [
        'salt' => env('SECURITY_SALT', 'default-salt-value'),
    ],
   'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Postgres',
            'host' => env('DB_HOST', ''),
            'username' => env('DB_USER', ''),
            'password' => env('DB_PASSWORD', ''),
            'database' => env('DB_DATABASE', ''),
            'port' => env('DB_PORT', '),
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'persistent' => false,
            'quoteIdentifiers' => true,
            'flags' => [
                \PDO::ATTR_PERSISTENT => false,
                \PDO::PGSQL_ATTR_DISABLE_PREPARES => true,
            ],
            'init' => [
                'SET timezone = UTC',
            ],

            'ssl_mode' => 'require',
            'ssl_ca' => null,
        ],
];
PHPEOF

echo "==> Running migrations.."
bin/cake migrations migrate -c default || true

echo "==> Dumping schema.."
bin/cake migrations dump -c default || true

echo "==> Starting Apache.."
apache2-foreground