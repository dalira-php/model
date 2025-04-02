<?php

namespace DaliraPhp;

class Generator
{
    public static function generateModelFromInput()
    {
        global $argv;

        // Check if a model name was provided
        if (!isset($argv[2])) {
            echo "Usage: composer require dalira-php/model && php vendor/dalira-php/model/generate.php ModelName\n";
            return;
        }

        $modelName = ucfirst($argv[2]); // Ensure first letter is uppercase

        $modelContent = <<<PHP
<?php

namespace App\Models;

use DBConnection;

/**
 * {$modelName} Model
 */
class {$modelName} extends DBConnection
{
    public function create(\$data)
    {
        \$sql = \$this->connect()->prepare("INSERT INTO dalira_table (data) VALUES (?)");
        \$sql->execute([\$data]);
        return \$sql;
    }

    public function read()
    {
        \$sql = \$this->connect()->prepare("SELECT * FROM dalira_table");
        \$sql->execute();
        return \$sql;
    }

    public function update(\$data, \$id)
    {
        \$sql = \$this->connect()->prepare("UPDATE dalira_table SET data = ? WHERE id = ?");
        \$sql->execute([\$data, \$id]);
        return \$sql;
    }

    public function delete(\$id)
    {
        \$sql = \$this->connect()->prepare("DELETE FROM dalira_table WHERE id = ?");
        \$sql->execute([\$id]);
        return \$sql;
    }
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
    }
}
