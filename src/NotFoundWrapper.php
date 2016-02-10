<?php

namespace UniversalAccess;

use UniversalAccess\WrapException;

class NotFoundWrapper extends Wrapper implements \ArrayAccess{
    public function __construct() {
			$this->type = 'NULL';
		}
    public function offsetGet($offset) {
        return new NotFoundWrapper();
    }
    public function offsetExists($offset) {
        return false;
    }
    public function offsetSet($offset, $v) {
        throw new WrapException('Can\'t set property of null value');
    }
    public function offsetUnset($offset) {
        throw new WrapException('Can\'t unset property of null value');
    }
    public function __get($offset) {
        return $this->offsetGet($offset);
    }
    public function __isset($offset) {
        return false;
    }
    public function raw() {
        return null;
    }
}
