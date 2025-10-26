<?php

namespace Rougin\Dexter\Error;

use Rougin\Dexter\Fixture\Routes\Tset;
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

        $text = 'The "setDeleteData" method must be overwriten in the concrete class.';

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

        $text = 'The "setIndexData" method must be overwriten in the concrete class.';

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

        $text = 'The "setShowData" method must be overwriten in the concrete class.';

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

        $text = 'The "setStoreData" method must be overwriten in the concrete class.';

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

        $text = 'The "setUpdateData" method must be overwriten in the concrete class.';

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
    protected function doSetUp()
    {
        $this->route = new Tset;
    }
}
