<?php

$root = __DIR__ . '/../Phinx';

$scripts = $root . '/Scripts';
$seeders = $root . '/Seeders';

$test = array();
$test['adapter'] = 'sqlite';
$test['name'] = ':memory';

$envs = array();
$envs['default_migration_table'] = 'phinxlog';
$envs['default_environment'] = 'test';
$envs['test'] = $test;

$data = array('paths' => array());
$data['environments'] = $envs;
$data['paths']['migrations'] = $scripts;
$data['paths']['seeds'] = $seeders;
$data['version_order'] = 'creation';

return $data;
