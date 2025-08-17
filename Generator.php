<?php

if ($argc < 2) {   
    echo "Usage: composer create-model MODEL_NAME\n";
    exit(1);
}

$modelName = ucfirst($argv[1]);

$modelContent = <<<PHP
<?php

namespace app\Models;

use config\DBConnection;
use PDO;
use PDOException

class $modelName
{
    private \$db;

    public function __construct(DBConnection \$db)
    {
        \$this->db = \$db->getConnection();
    }
    
    // Add your custom methods below to interact with the database.
}
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