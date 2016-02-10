<?php

namespace UniversalAccess;

use UniversalAccess\WrapException;
use UniversalAccess\Wrapper;
use UniversalAccess\NotFoundWrapper;

class ArrayWrapper extends Wrapper implements \ArrayAccess {
    private $array;

    public function __construct($any) {
        if (is_array($any)) {
            $this->any  = $any;
						$this->type = 'array';
        } else {
            throw new WrapException('ArrayWrapper wraps only arrays');
        }
    }

    public function offsetGet($offset) {
        if (isset($this->any[$offset])) {
            return Wrapper::wrap($this->any[$offset]);
        } else {
            return new NotFoundWrapper();
        }
    }
    public function __isset($offset) {
        return isset($this->any[$offset]);
    }
    public function offsetSet($offset, $v) {
        $this->any->$offset = $v;
    }
    public function offsetUnset($offset) {
        unset($this->any->$offset);
    }
}
