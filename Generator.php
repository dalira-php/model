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

/**
 * Class $modelName
 * 
 * This class serves as a facade for handling the database interactions
 * related to the 'Posts' model. It abstracts the complexity of database
 * queries, providing a simple interface for managing posts.
 * 
 * @package app\Models
 */
class $modelName
{
    /**
     * @var \PDO
     * 
     * The database connection instance.
     */
    private \$db;

    /**
     * $modelName constructor.
     *
     * Initializes the database connection.
     * 
     * @param DBConnection \$db The DBConnection instance to be used for
     * establishing the database connection.
     */
    public function __construct(DBConnection \$db)
    {
        // Get the database connection from DBConnection class
        \$this->db = \$db->getConnection();
    }

    // Add your models below. Methods can be added to interact with posts data,
    // such as creating, updating, deleting posts, etc.
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
