<?php

namespace Rougin\Dexter\Error;

use Rougin\Dexter\Fixture\Routes\Tset;
use Rougin\Dexter\Fixture\Routes\Unified;
use Rougin\Dexter\Testcase;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class RouteTest extends Testcase
{
    /**
     * @var \Rougin\Dexter\Fixture\Routes\Tset
     */
    protected $route;

    /**
     * @return void
     */
    public function test_delete_error()
    {
        $http = $this->withHttp();

        $text = 'The "setDeleteData" method must be overwritten in the concrete class.';

        $this->doExpectExceptionMessage($text);

        $this->route->delete(1, $http);
    }

    /**
     * @return void
     */
    public function test_delete_invalid()
    {
        $http = $this->withHttp();

        $this->route->setAsInvalid();

        $response = $this->route->delete(1, $http);

        $expected = 404;

        $actual = $response->getStatusCode();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function test_index_error()
    {
        $http = $this->withHttp();

        $text = 'The "setIndexData" method must be overwritten in the concrete class.';

        $this->doExpectExceptionMessage($text);

        $this->route->index($http);
    }

    /**
     * @return void
     */
    public function test_index_invalid()
    {
        $http = $this->withHttp();

        $this->route->setAsInvalid();

        $response = $this->route->index($http);

        $expected = 422;

        $actual = $response->getStatusCode();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function test_show_error()
    {
        $http = $this->withHttp();

        $text = 'The "setShowData" method must be overwritten in the concrete class.';

        $this->doExpectExceptionMessage($text);

        $this->route->show(1, $http);
    }

    /**
     * @return void
     */
    public function test_show_invalid()
    {
        $http = $this->withHttp();

        $this->route->setAsInvalid();

        $response = $this->route->show(1, $http);

        $expected = 404;

        $actual = $response->getStatusCode();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function test_store_error()
    {
        $http = $this->withHttp();

        $text = 'The "setStoreData" method must be overwritten in the concrete class.';

        $this->doExpectExceptionMessage($text);

        $this->route->store($http);
    }

    /**
     * @return void
     */
    public function test_store_invalid()
    {
        $http = $this->withHttp();

        $this->route->setAsInvalid();

        $response = $this->route->store($http);

        $expected = 422;

        $actual = $response->getStatusCode();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function test_update_error()
    {
        $http = $this->withHttp();

        $text = 'The "setUpdateData" method must be overwritten in the concrete class.';

        $this->doExpectExceptionMessage($text);

        $this->route->update(1, $http);
    }

    /**
     * @return void
     */
    public function test_update_invalid()
    {
        $http = $this->withHttp();

        $this->route->setAsInvalid();

        $response = $this->route->update(1, $http);

        $expected = 422;

        $actual = $response->getStatusCode();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function test_invalid_unified_delete()
    {
        $http = $this->withHttp();

        $route = new Unified;

        $route->setAsInvalid();

        $route->delete(7, $http);

        $expected = 404;

        $actual = $route->getCode();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function test_invalid_unified_index()
    {
        $http = $this->withHttp();

        $route = new Unified;

        $route->setAsInvalid();

        $route->index($http);

        $expected = 422;

        $actual = $route->getCode();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function test_invalid_unified_show()
    {
        $http = $this->withHttp();

        $route = new Unified;

        $route->setAsInvalid();

        $route->show(7, $http);

        $expected = 404;

        $actual = $route->getCode();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function test_invalid_unified_store()
    {
        $http = $this->withHttp();

        $route = new Unified;

        $route->setAsInvalid();

        $route->store($http);

        $expected = 422;

        $actual = $route->getCode();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function test_invalid_unified_update()
    {
        $http = $this->withHttp();

        $route = new Unified;

        $route->setAsInvalid();

        $route->update(7, $http);

        $expected = 422;

        $actual = $route->getCode();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function test_is_valid_unified_index()
    {
        $http = $this->withHttp();

        $route = new Unified;

        $route->setAsInvalid();

        $route->index($http);

        $expected = 0;

        $actual = $route->getId();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function test_is_valid_unified_store()
    {
        $http = $this->withHttp();

        $route = new Unified;

        $route->setAsInvalid();

        $route->store($http);

        $expected = 0;

        $actual = $route->getId();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    public function test_is_valid_unified_update()
    {
        $http = $this->withHttp();

        $route = new Unified;

        $route->setAsInvalid();

        $route->update(7, $http);

        $expected = 7;

        $actual = $route->getId();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     */
    protected function doSetUp()
    {
        $this->route = new Tset;
    }
}
