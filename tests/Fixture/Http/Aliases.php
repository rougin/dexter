<?php

/**
 * This file is only to be used for "PHPstan".
 * For its autoloading, kindly see "Interop".
 */

// @codeCoverageIgnoreStart
use Rougin\Dexter\Http\Interop;

$http = 'Rougin\Dexter\Fixture\Http';

$number = Interop::isVersion2() ? '\V2' : '\V1';

$orig = $http . $number . '\ServerRequest';
class_alias($orig, $http . '\PsrServerRequest');
// @codeCoverageIgnoreEnd
