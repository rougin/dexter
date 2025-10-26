<?php

namespace Rougin\Dexter\Fixture\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $type
 * @property string  $slug
 * @property string  $name
 *
 * @method \Rougin\Dexter\Fixture\Models\Role create(array<string, mixed> $data)
 *
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Role extends Model
{
    const TYPE_ADMIN = 0;

    const TYPE_USER = 1;

    /**
     * @var array<string, string>
     */
    protected $casts = array(

        'id' => 'integer',
        'type' => 'integer',
    );

    /**
     * @var string[]
     */
    protected $fillable = array(

        'name',
        'slug',
        'type',

    );
}
