<?php

namespace Rougin\Dexter;

use Rougin\Dexter\Fixture\Depots\ResuDepot;
use Rougin\Dexter\Fixture\Depots\RoleDepot;
use Rougin\Dexter\Fixture\Depots\UserDepot;
use Rougin\Dexter\Fixture\Models\Role;
use Rougin\Dexter\Fixture\Models\User;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class DepotTest extends Testcase
{
    /**
     * @var \Rougin\Dexter\Fixture\Depots\UserDepot
     */
    protected $depot;

    /**
     * @return void
     */
    public function test_create_new_item()
    {
        $load = array('name' => 'Sample');
        $load['email'] = 'smpl@roug.in';

        $result = $this->depot->create($load);

        $expect = $load['name'];

        $actual = $result->name;

        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_delete_item()
    {
        // Create a new user ---------------
        $load = array('name' => 'Sample');
        $load['email'] = 'smpl@roug.in';

        $item = $this->depot->create($load);
        // ---------------------------------

        $actual = $this->depot->delete($item->id);

        $this->assertTrue($actual);
    }

    /**
     * @return void
     */
    public function test_filter_items()
    {
        $depot = new RoleDepot(new Role);

        $expect = array();

        // Create sample roles -----------------
        $row = array('name' => 'Administrator');
        $row['type'] = Role::TYPE_ADMIN;
        $row['slug'] = 'administrator';
        $depot->create($row);

        $row = array('name' => 'Common User');
        $row['type'] = Role::TYPE_USER;
        $row['slug'] = 'common-user';
        $expect[] = $row;
        $depot->create($row);

        $row = array('name' => 'Default User');
        $row['type'] = Role::TYPE_USER;
        $row['slug'] = 'default-user';
        $expect[] = $row;
        $depot->create($row);
        // -------------------------------------

        // Create a filter and add it to the depot ------
        $filter = new Filter;
        $filter->setInt('type', Role::TYPE_USER);
        $filter->setStr('name', 'user');
        $filter->withSearch('name');
        $depot->withFilter($filter);
        // ----------------------------------------------

        $actual = $depot->get(1, 5)->items();

        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_items_by_offset()
    {
        $expect = 'Dexterity';

        $depot = new ResuDepot(new User);

        $result = $depot->get(4, 1);

        /** @var array<string, string>[] */
        $items = $result->itemsAsArray();

        $actual = $items[0]['name'];

        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_update_item()
    {
        // Create a new user ---------------
        $load = array('name' => 'Sample');
        $load['email'] = 'smpl@roug.in';

        $item = $this->depot->create($load);
        // ---------------------------------

        $load = array('name' => 'Elpmas');

        $this->depot->update($item->id, $load);

        $item = $this->depot->find($item->id);

        $expect = $load['name'];

        $actual = $item->name;

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

        $this->depot = $depot;
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
