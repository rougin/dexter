<?php

namespace Rougin\Dexter\Fixture\Depots;

use Rougin\Dexter\Depots\EloquentDepot;
use Rougin\Dexter\Fixture\Models\Role;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class RoleDepot extends EloquentDepot
{
    /**
     * @param \Rougin\Dexter\Fixture\Models\Role $role
     */
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * @param \Rougin\Dexter\Fixture\Models\Role $row
     *
     * @return array<string, mixed>
     */
    protected function asRow($row)
    {
        $data = array();

        $data['type'] = $row->type;

        $data['slug'] = $row->slug;

        $data['name'] = $row->name;

        return $data;
    }
}
