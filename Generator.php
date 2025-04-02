<?php

if ($argc < 2) {
    echo "Usage: php Generator.php ModelName\n";
    exit(1);
}

$modelName = ucfirst($argv[1]);

$modelContent = <<<PHP
<?php

namespace app\Models;

use config\DBConnection;

class {$modelName}
{
    private $db;

    public function __construct(DBConnection $db)
    {
        $this->db = $db->getConnection();
    }
}
<?php
PHP;

$path = getcwd() . '/app/Models/' . $modelName . '.php';

if (!file_exists(dirname($path))) {
    mkdir(dirname($path), 0777, true);
}

if (!file_exists($path)) {
    file_put_contents($path, $modelContent);
    echo "{$modelName}.php created successfully in app/Models\n";
} else {
    echo "{$modelName}.php already exists. Skipping...\n";
}
