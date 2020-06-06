<?php

namespace CI4Xpander\Commands\Maker;

class Migration extends \CodeIgniter\CLI\BaseCommand
{
    protected $group = 'Xpander';
    protected $name = 'xpander:make:migration';
    protected $description = 'Make xpander migration';
    protected $usage = 'xpander:make:migration [name] [namespace]';
    protected $arguments = [
        'name' => 'Migration name',
        'namespace' => 'Namespace'
    ];
    protected $options = [];

    public function run(array $params = [])
    {
        helper('inflector');
        $name = array_shift($params);
        $ns = array_shift($params);

        if (empty($name)) {
            $name = \CodeIgniter\CLI\CLI::prompt(lang('Migrations.nameMigration'));
        }

        if (empty($name)) {
            \CodeIgniter\CLI\CLI::error(lang('Migrations.badCreateName'));
            return;
        }

        $homepath = APPPATH;

        if (!empty($ns)) {
            // Get all namespaces
            $namespaces = \Config\Services::autoloader()->getNamespace();

            foreach ($namespaces as $namespace => $path) {
                if ($namespace === $ns) {
                    $homepath = realpath(reset($path));
                    break;
                }
            }
        } else {
            $ns = 'App';
        }

        // Always use UTC/GMT so global teams can work together
        $config   = config('Migrations');
        $fileName = gmdate($config->timestampFormat) . $name;

        // full path
        $path = $homepath . '/Database/Migrations/' . $fileName . '.php';

        // Class name should be pascal case now (camel case with upper first letter)
        $name = pascalize($name);

        $template = <<<EOD
<?php namespace $ns\Database\Migrations;

class {name} extends \CI4Xpander\Migration
{
	public function up()
	{
        \$this->db->transStart();



        \$this->db->transComplete();
	}

	//--------------------------------------------------------------------

	public function down()
	{
        \$this->db->transStart();



        \$this->db->transComplete();
	}
}

EOD;
        $template = str_replace('{name}', $name, $template);

        helper('filesystem');
        if (!write_file($path, $template)) {
            \CodeIgniter\CLI\CLI::error(lang('Migrations.writeError', [$path]));
            return;
        }

        \CodeIgniter\CLI\CLI::write('Created file: ' . \CodeIgniter\CLI\CLI::color(str_replace($homepath, $ns, $path), 'green'));
    }
}
