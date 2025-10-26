<?php

namespace Rougin\Dexter;

use Rougin\Dexter\Fixture\Depots\UserDepot;
use Rougin\Dexter\Fixture\Models\User;
use Rougin\Dexter\Fixture\Routes\Users;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class RouteTest extends Testcase
{
    /**
     * @var \Rougin\Dexter\Fixture\Routes\Users
     */
    protected $route;

    /**
     * @return void
     */
    public function test_delete_method()
    {
        // Create a new user ------------
        $model = new User;

        $load = array('name' => 'Hello');
        $load['email'] = 'hello@roug.in';

        $item = $model->create($load);
        // ------------------------------

        $this->doSetExpectedException('UnexpectedValueException');

        $http = $this->withHttp();

        $this->route->delete($item->id, $http);

        $this->route->show($item->id, $http);
    }

    /**
     * @return void
     */
    public function test_index_method()
    {
        $http = $this->withHttp();

        $response = $this->route->index($http);

        $expect = '{"pages":1,"limit":10,"total":5,"items":[{"id":1,"name":"Slytherin","email":"sltr@roug.in"},{"id":2,"name":"Rougin Gutib","email":"me@roug.in"},{"id":3,"name":"Authsum","email":"atsm@roug.in"},{"id":4,"name":"Dexterity","email":"dxtr@roug.in"},{"id":5,"name":"Combustor","email":"cbtr@roug.in"}]}';

        $actual = $response->getBody()->__toString();

        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_show_method()
    {
        $http = $this->withHttp();

        $response = $this->route->show(4, $http);

        $expect = '{"id":4,"name":"Dexterity","email":"dxtr@roug.in"}';

        $actual = $response->getBody()->__toString();

        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_store_method()
    {
        $load = array('name' => 'Hello');
        $load['email'] = 'hello@roug.in';

        $http = $this->withHttp($load, true);

        $response = $this->route->store($http);

        $expect = 201;

        $actual = $response->getStatusCode();

        $this->assertEquals($expect, $actual);

        $id = $response->getBody()->__toString();
    }

    /**
     * @return void
     */
    public function test_update_method()
    {
        // Create a new user ------------
        $model = new User;

        $load = array('name' => 'Hello');
        $load['email'] = 'hello@roug.in';

        $item = $model->create($load);
        // ------------------------------

        $load = array('name' => 'Olleh');

        $http = $this->withHttp($load, true);

        $this->route->update($item->id, $http);

        $response = $this->route->show($item->id, $http);

        $expect = '{"id":' . $item->id . ',"name":"Olleh","email":"hello@roug.in"}';

        $actual = $response->getBody()->__toString();

        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    protected function doSetUp()
    {
        $this->startUp();

        $this->migrate();

        $this->hydrate();

        $depot = new UserDepot(new User);

        $route = new Users($depot);

        $this->route = $route;
    }

    /**
     * @return void
     */
    protected function doTearDown()
    {
        $this->rollback();

        $this->shutdown();
    }
}
