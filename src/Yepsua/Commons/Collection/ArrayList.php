<?php

namespace Yepsua\Commons\Collection;

use ArrayObject;
use ArrayAccess;

/**
 * An Array object implementation.
 *
 * @author <a href="mailto:omar.yepez@yepsua.com">Omar Yepez</a>
 */
class ArrayList extends ArrayObject implements ArrayAccess
{
    private $items = array();

    public function getItems()
    {
        return $this->items;
    }

    public function add($key, $value)
    {
        $this->items[$key] = $value;

        return $this;
    }

    public function get($key)
    {
        return (isset($this->items[$key])) ? $this->items[$key] : null;
    }

    public function contains($key)
    {
        return isset($this->items[$key]);
    }

    public function delete($key)
    {
        $success = false;
        if (isset($this->items[$key])) {
            unset($this->items[$key]);
            $success = true;
        }

        return $success;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->items[] = $value;
        } else {
            $this->add($offset, $value);
        }
    }

    public function offsetExists($offset)
    {
        return $this->contains($offset);
    }

    public function offsetUnset($offset)
    {
        return $this->delete($offset);
    }

    public function offsetGet($offset)
    {
        $this->get($offset);
    }
}
