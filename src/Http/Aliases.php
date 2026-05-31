<?php

/**
 * This file is only to be used for "PHPstan".
 * For its autoloading, kindly see "Interop".
 */

// @codeCoverageIgnoreStart
use Rougin\Dexter\Http\Interop;

$http = 'Rougin\Dexter\Http';

$number = Interop::isVersion2() ? '\V2' : '\V1';

$orig = $http . $number . '\Response';
class_alias($orig, $http . '\PsrResponse');

$orig = $http . $number . '\Stream';
class_alias($orig, $http . '\PsrStream');
// @codeCoverageIgnoreEnd
