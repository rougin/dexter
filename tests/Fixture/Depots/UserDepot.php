<?php

namespace Rougin\Dexter\Fixture\Depots;

use Rougin\Dexter\Depots\EloquentDepot;
use Rougin\Dexter\Fixture\Models\User;

/**
 * @method \Rougin\Dexter\Fixture\Models\User create(array<string, mixed> $data)
 * @method \Rougin\Dexter\Fixture\Models\User find(integer $id)
 *
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class UserDepot extends EloquentDepot
{
    /**
     * @param \Rougin\Dexter\Fixture\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param \Rougin\Dexter\Fixture\Models\User $row
     *
     * @return array<string, mixed>
     */
    protected function asRow($row)
    {
        // PHP 5.3 - '"id":1' returns '"id":"1"' instead, ---
        // even manually adding "id" to "$casts" property ---
        $data = array('id' => (int) $row->id);
        // --------------------------------------------------

        $data['name'] = $row->name;

        $data['email'] = $row->email;

        return $data;
    }
}
