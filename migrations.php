<?php

return [
    'migrations_paths' => [
        'Database\Migrations' => 'database/migrations',
    ],
    'table_storage' => [
        'table_name' => 'doctrine_migration_versions',
        'version_column_length' => 191,
    ],
    'all_or_nothing' => true,
    'check_database_platform' => true,
];
