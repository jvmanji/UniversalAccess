<?php

namespace UniversalAccess;

use UniversalAccess\WrapException;
use UniversalAccess\Wrapper;
use UniversalAccess\NotFoundWrapper;

class OtherWrapper extends Wrapper implements \ArrayAccess {
	public function __construct($any) {
		if (!is_object($any) && !is_array($any) && !is_null($any)) {
			$this->any  = $any;
			$this->type = gettype($any);
		} else {
			throw new WrapException('OtherWrapper wraps everything other than arrays, objects and null');
		}
	}

	// think about support for strings
	public function offsetGet($offset) {
		return new NotFoundWrapper();
	}
	public function __isset($offset) {
		return false;
	}
	public function offsetSet($offset, $v) {
	}
	public function offsetUnset($offset) {
	}
}
