<?php

namespace UniversalAccess;

use UniversalAccess\ArrayWrapper;
use UniversalAccess\ObjectWrapper;
use UniversalAccess\NotFoundWrapper;

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
