<?php

namespace UniversalAccess;

use UniversalAccess\ArrayWrapper;
use UniversalAccess\ObjectWrapper;
use UniversalAccess\NotFoundWrapper;

class Wrapper implements \Iterator {
    protected $any, $type;

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
				// TODO
				//  classes:
				//  - BooleanWrapper
				//  – IntegerWrapper
				//  – FloatWrapper
				//  – DoubleWrapper
				//  – StringWrapper
				//  methods for wrappers:
				//  – isInt/isInteger
				//  – isObj/isObject
				//  – isArr/isArray
				//  - isBool/isBoolean
				//  - isNull
				//  - isString
				//  - isFloat
				//  - isDouble
            return new OtherWrapper($any);
        }
    }

		public function isFloat() {
			return $this->type == 'float';
		}
		public function isDouble() {
			return $this->type == 'double';
		}
		public function isString() {
			return $this->type == 'string';
		}
		public function isNull() {
			return $this->type == 'NULL';
		}
		public function isBool() {
			return $this->isBoolean();
		}
		public function isBoolean() {
			return $this->type == 'boolean';
		}
		public function isArr() {
			return $this->isArray();
		}
		public function isArray() {
			return $this->type == 'array';
		}
		public function isObj() {
			return $this->isObject();
		}
		public function isObject() {
			return $this->type == 'object';
		}
		public function isInt() {
			return $this->isInteger();
		}
		public function isInteger() {
			return $this->type == 'integer';
		}

		public function rewind() {
			reset($this->any);
		}

		public function current() {
			return Wrapper::wrap(current($this->any));
		}

		public function key() {
			return key($this->any);
		}

		public function next() {
			return Wrapper::wrap(next($this->any));
		}

		public function valid() {
			$key = key($this->any);
			$res = ($key !== NULL && $key !== FALSE);
			return $res;
		}

    public function raw() {
        return $this->any;
    }
    public function offsetExists($offset) {
        return $this->__isset($offset);
    }
    public function __get($offset) {
        return $this->offsetGet($offset);
    }

}
