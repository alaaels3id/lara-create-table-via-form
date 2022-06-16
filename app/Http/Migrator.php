<?php

namespace App\Http;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class Migrator
{
    protected static string $table;

    public static function create($tableName)
    {
        static::$table = Str::plural($tableName);

        $filesystem = new Filesystem();

        $file_path = base_path('database/migrations/') . static::setMigrationFileName() . '.php';

        $content = static::getFileContent();

        if(Schema::hasTable($tableName)) return false;

        $filesystem->put($file_path, $content);

        return true;
    }

    private static function setMigrationFileName()
    {
        return date('Y') . '_' . date('m') . '_' . date('d') . '_' . time() . '_create_' . static::$table . '_table';
    }

    private static function getFileContent()
    {
        $stub = __DIR__ . '/../../stubs/migrator.stub';

        $content = file_get_contents($stub);

        $content = str_replace('{{ table }}', static::$table, $content);

        return str_replace('{{ slot }}', static::getSlot(), $content);
    }

    private static function getSlot(): string
    {
        $req = request();

        $slot = '';

        $last = array_key_last($req->columns);

        foreach ($req->columns as $i => $name)
        {
            $attributes = $req->get('attributes')[$i];

            $_attr = '$table';

            foreach ($attributes as $j => $attribute)
            {
                $_attr .= "->" . $attribute . (($j == 0) ? '(\''.$name.'\')' : '()');
            }

            $slot .= $_attr . ';' . (($last !== $i) ? PHP_EOL : '') . "\t\t\t";
        }

        return $slot;
    }
}
