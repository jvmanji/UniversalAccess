<?php

namespace UniversalAccess;

class WrapException extends \Exception {}

class Wrapper {
    protected $any;

    public function __construct($any = null) {
        $this->any = $any;
    }

    public static function wrap($any) {
        if (is_array($any)) {
            return new ArrayWrapper($any);
        } elseif (is_object($any)) {
            return new ObjectWrapper($any);
        } elseif ($any === null) {
            return new NotFoundWrapper();
        } else {
            return $any;
        }
    }
}

class NotFoundWrapper extends Wrapper implements \ArrayAccess{
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

class ObjectWrapper extends Wrapper implements \ArrayAccess {
    public function __construct($any) {
        if (is_object($any)) {
            $this->any = $any;
        } else {
            throw new WrapException('ObjectWrapper wraps only objects');
        }
    }

    public function offsetGet($offset) {
        if (isset($this->any->$offset)) {
            return Wrapper::wrap($this->any->$offset);
        } else {
            return new NotFoundWrapper();
        }
    }

    public function __get($offset) {
        return $this->offsetGet($offset);
    }

    public function __isset($offset) {
        return isset($this->any->$offset);
    }
    public function raw() {
        return $this->any;
    }
    public function offsetExists($offset) {
        return $this->__isset($offset);
    }
    public function offsetSet($offset, $v) {
        $this->any[$offset] = $v;
    }
    public function offsetUnset($offset) {
        unset($this->any[$offset]);
    }
}

class ArrayWrapper extends Wrapper implements \ArrayAccess {
    private $array;

    public function __construct($any) {
        if (is_array($any)) {
            $this->any = $any;
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

    public function __get($offset) {
        return $this->offsetGet($offset);
    }

    public function __isset($offset) {
        return isset($this->any[$offset]);
    }
    public function raw() {
        return $this->any;
    }
    public function offsetExists($offset) {
        return $this->__isset($offset);
    }
    public function offsetSet($offset, $v) {
        $this->any->$offset = $v;
    }
    public function offsetUnset($offset) {
        unset($this->any->$offset);
    }
}
