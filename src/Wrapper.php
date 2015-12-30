<?php

namespace UniversalAccess;

use UniversalAccess\ArrayWrapper;
use UniversalAccess\ObjectWrapper;
use UniversalAccess\NotFoundWrapper;

class Wrapper implements \Iterator {
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
}
