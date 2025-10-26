<?php

namespace Rougin\Dexter\Depots;

use Rougin\Dexter\Depot;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class EloquentDepot extends Depot
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Creates a new item.
     *
     * @param array<string, mixed> $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($data)
    {
        /** @phpstan-ignore-next-line */
        return $this->model->create($data);
    }

    /**
     * Returns the total number of items.
     *
     * @return integer
     */
    public function getTotal()
    {
        return $this->model->count();
    }

    /**
     * Checks if the specified item exists.
     *
     * @param integer $id
     *
     * @return boolean
     */
    public function rowExists($id)
    {
        $model = $this->model;

        /** @phpstan-ignore-next-line */
        $model = $model->where('id', $id);

        return $model->exists();
    }

    /**
     * Updates the specified item.
     *
     * @param integer              $id
     * @param array<string, mixed> $data
     *
     * @return boolean
     */
    public function update($id, $data)
    {
        return $this->findRow($id)->update($data);
    }

    /**
     * Deletes the specified item.
     *
     * @param integer $id
     *
     * @return boolean
     */
    protected function deleteRow($id)
    {
        /** @var boolean */
        return $this->findRow($id)->delete();
    }

    /**
     * Returns the specified item.
     *
     * @param integer $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \UnexpectedValueException
     */
    protected function findRow($id)
    {
        try
        {
            /** @phpstan-ignore-next-line */
            return $this->model->findOrFail($id);
        }
        catch (\Exception $e)
        {
            $text = $e->getMessage();

            throw new \UnexpectedValueException($text);
        }
    }

    /**
     * Returns the items with filters.
     *
     * @param integer $page
     * @param integer $limit
     *
     * @return \Illuminate\Database\Eloquent\Model[]
     */
    protected function getItems($page, $limit)
    {
        /** @phpstan-ignore-next-line */
        $model = $this->model->limit($limit);

        $offset = $this->getOffset($page, $limit);

        if (! $this->filter)
        {
            return $model->offset($offset)->get();
        }

        $search = $this->filter->getSearchKeys();

        $items = $this->filter->getData();

        foreach ($items as $name => $value)
        {
            if (! in_array($name, $search))
            {
                $model = $model->where($name, $value);

                continue;
            }

            $value = '%' . $items[$name] . '%';

            $model->orWhere($name, 'like', $value);
        }

        return $model->offset($offset)->get();
    }
}
