<?php

namespace Rougin\Dexter\Fixture\Depots;

use Rougin\Dexter\Depots\EloquentDepot;
use Rougin\Dexter\Fixture\Models\User;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class ResuDepot extends EloquentDepot
{
    /**
     * @param \Rougin\Dexter\Fixture\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
