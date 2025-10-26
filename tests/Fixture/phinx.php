<?php

$root = __DIR__ . '/Phinx';

$scripts = $root . '/Scripts';
$seeders = $root . '/Seeders';

$test = array();
$test['adapter'] = 'sqlite';
$test['name'] = __DIR__ . '/Storage/dxtr';
$test['suffix'] = '.s3db';

$items = array();
$items['default_migration_table'] = 'phinxlog';
$items['default_environment'] = 'testing';
$items['testing'] = $test;

$env = array('paths' => array());
$env['environments'] = $items;
$env['paths']['migrations'] = $scripts;
$env['paths']['seeds'] = $seeders;
$env['version_order'] = 'creation';

return $env;
