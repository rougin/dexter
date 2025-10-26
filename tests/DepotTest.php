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
    public function doSetUp()
    {
        $this->loadEloquent();

        $this->depot = new UserDepot(new User);
    }

    /**
     * @depends test_items_by_offset
     *
     * @return integer
     */
    public function test_create_new_item()
    {
        $payload = array('name' => 'Sample');
        $payload['email'] = 'smpl@roug.in';

        /** @var \Rougin\Dexter\Fixture\Models\User */
        $result = $this->depot->create($payload);

        $expect = $payload['name'];

        $actual = $result->name;

        $this->assertEquals($expect, $actual);

        return $result->id;
    }

    /**
     * @depends test_update_item
     *
     * @param integer $id
     *
     * @return void
     */
    public function test_delete_item($id)
    {
        $this->assertTrue($this->depot->delete($id));
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
        $expect = 'Dexter';

        $depot = new ResuDepot(new User);

        $result = $depot->get(4, 1);

        /** @var array<string, string>[] */
        $items = $result->itemsAsArray();

        $actual = $items[0]['name'];

        $this->assertEquals($expect, $actual);
    }

    /**
     * @depends test_create_new_item
     *
     * @param integer $id
     *
     * @return integer
     */
    public function test_update_item($id)
    {
        $payload = array('name' => 'Elpmas');

        $this->depot->update($id, $payload);

        /** @var array<string, mixed> */
        $result = $this->depot->find($id);

        $expect = $payload['name'];

        $actual = $result['name'];

        $this->assertEquals($expect, $actual);

        return $id;
    }
}
