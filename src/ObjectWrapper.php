<?php

namespace UniversalAccess;

use UniversalAccess\WrapException;
use UniversalAccess\Wrapper;
use UniversalAccess\NotFoundWrapper;

class ObjectWrapper extends Wrapper implements \ArrayAccess {
	public function __construct($any) {
		if (is_object($any)) {
			$this->any  = $any;
			$this->type = 'object';
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
	public function __isset($offset) {
		return isset($this->any->$offset);
	}
	public function offsetSet($offset, $v) {
		$this->any[$offset] = $v;
	}
	public function offsetUnset($offset) {
		unset($this->any[$offset]);
	}
}
