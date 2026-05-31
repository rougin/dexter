<?php

namespace Rougin\Dexter;

use Illuminate\Database\Capsule\Manager as Capsule;
use LegacyPHPUnit\TestCase as Legacy;
use Rougin\Dexter\Fixture\Models\User;
use Rougin\Dexter\Fixture\Container;
use Rougin\Dexter\Fixture\Http\ServerRequest;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Testcase extends Legacy
{
    /**
     * @var \Illuminate\Database\Capsule\Manager
     */
    protected $capsule;

    /**
     * @param string $pattern
     * @param string $string
     *
     * @return void
     */
    public function doAssertRegex($pattern, $string)
    {
        $method = 'assertMatchesRegularExpression';

        /** @phpstan-ignore-next-line */
        if (method_exists($this, $method))
        {
            $this->assertMatchesRegularExpression($pattern, $string);

            return;
        }

        /** @phpstan-ignore-next-line */
        $this->assertRegExp($pattern, $string);
    }

    /**
     * @param string $message
     *
     * @return void
     */
    public function doExpectExceptionMessage($message)
    {
        /** @phpstan-ignore-next-line */
        if (! method_exists($this, 'expectExceptionMessage'))
        {
            $exception = 'Exception';

            /** @phpstan-ignore-next-line */
            $this->setExpectedException($exception, $message);

            return;
        }

        $this->expectExceptionMessage($message);
    }

    /**
     * @param string $exception
     *
     * @return void
     */
    public function doSetExpectedException($exception)
    {
        /** @phpstan-ignore-next-line */
        if (method_exists($this, 'expectException'))
        {
            /** @phpstan-ignore-next-line */
            $this->expectException($exception);

            return;
        }

        /** @phpstan-ignore-next-line */
        $this->setExpectedException($exception);
    }

    /**
     * @param string|string[] $paths
     *
     * @return integer
     */
    protected function getLastVersion($paths)
    {
        if (is_string($paths))
        {
            $paths = array($paths);
        }

        $version = 0;

        foreach ($paths as $path)
        {
            $files = glob($path . '/*.php');

            $files = $files !== false ? $files : array();

            foreach ($files as $file)
            {
                $temp = basename($file, '.php');

                $version = substr($temp, 0, 14);

                $version = (int) $version;
            }
        }

        return $version;
    }

    /**
     * @return void
     */
    protected function hydrate()
    {
        $model = new User;

        $email = 'sltr@roug.in';
        $name = 'Slytherin';
        $data = compact('name', 'email');
        $model->create($data);

        $email = 'me@roug.in';
        $name = 'Rougin Gutib';
        $data = compact('name', 'email');
        $model->create($data);

        $email = 'atsm@roug.in';
        $name = 'Authsum';
        $data = compact('name', 'email');
        $model->create($data);

        $email = 'dxtr@roug.in';
        $name = 'Dexterity';
        $data = compact('name', 'email');
        $model->create($data);

        $email = 'cbtr@roug.in';
        $name = 'Combustor';
        $data = compact('name', 'email');
        $model->create($data);
    }

    /**
     * @return void
     */
    protected function migrate()
    {
        $phinx = $this->setPhinx();

        // Get the last version (e.g., "20241213094622") ---
        // PHP 5.3 - Get paths directly instead ---
        $folder = __DIR__ . '/Fixture/Config';

        $config = require $folder . '/Phinx.php';

        /** @phpstan-ignore-next-line */
        $paths = $config['paths']['migrations'];
        // ----------------------------------------

        /** @phpstan-ignore-next-line */
        $version = $this->getLastVersion($paths);
        // -------------------------------------------------

        // Run the migration up to the specified version ---
        $phinx->migrate('test', $version);
        // -------------------------------------------------
    }

    /**
     * @return void
     */
    protected function rollback()
    {
        $this->setPhinx()->migrate('test', 0);
    }

    /**
     * @return \Phinx\Migration\Manager
     */
    protected function setPhinx()
    {
        $fixture = __DIR__ . '/Fixture';

        $app = new Container;

        // Prepare the PDO to the configuration file ------
        $pdo = $this->capsule->getConnection()->getPdo();

        $data = require $fixture . '/Config/Phinx.php';

        /** @phpstan-ignore-next-line */
        $data['environments']['test']['connection'] = $pdo;

        $name = 'Phinx\Config\ConfigInterface';

        /** @phpstan-ignore-next-line */
        $app->set($name, new \Phinx\Config\Config($data));
        // ------------------------------------------------

        // Prepare the "Input", "Output" classes ------
        $console = 'Symfony\Component\Console';

        $input = $console . '\Input\InputInterface';

        $app->set($input, new ArrayInput(array()));

        $output = $console . '\Output\OutputInterface';

        $app->set($output, new NullOutput);
        // --------------------------------------------

        // PHP 5.3 - Use "Reflection API" for "Manager" ---
        // as it has different arguments in >= "v0.6.0" ---
        /** @var \Phinx\Migration\Manager */
        return $app->get('Phinx\Migration\Manager');
        // ------------------------------------------------
    }

    /**
     * @return void
     */
    protected function shutdown()
    {
        // PHP 5.3 - "disconnect" is an undefined method ---
        // $this->capsule->getConnection()->disconnect();
        // -------------------------------------------------
    }

    /**
     * @return void
     */
    protected function startUp()
    {
        $capsule = new Capsule;

        // Set database in memory -----
        $data = array('prefix' => '');

        $data['database'] = ':memory:';

        $data['driver'] = 'sqlite';
        // ----------------------------

        $capsule->addConnection($data);

        $capsule->setAsGlobal();

        $capsule->bootEloquent();

        $this->capsule = $capsule;
    }

    /**
     * @param array<string, mixed> $data
     * @param boolean              $parsed
     *
     * @return \Psr\Http\Message\ServerRequestInterface
     */
    protected function withHttp($data = array(), $parsed = false)
    {
        // Mock the details from $_SERVER ----
        $server = array('REQUEST_URI' => '/');

        $server['REQUEST_METHOD'] = 'GET';

        $server['SERVER_NAME'] = 'localhost';

        $server['SERVER_PORT'] = '8000';
        // -----------------------------------

        $request = new ServerRequest($server);

        if ($parsed)
        {
            return $request->withParsedBody($data);
        }

        /** @var array<string, string> */
        $params = $data;

        return $request->withQueryParams($params);
    }
}
