<?php

namespace Neos\Start;

use o;

class Utils {

    //Insert a autoLoader class extras.
    //TODO: create for MODULES, PLUGUINS, ETC . .  .
    function autoload($type = 'model') {
        spl_autoload_register(
                function($class) {
            $class = str_replace('\\', '/', trim($class, '\\'));
            if ($m = strpos($class, 'Model/') !== false) {
                if ($m != 5) return false;
                require_once o::app('model') . substr($class, $m + 5) . '.php';
                return true;
            } elseif ($m = strpos($class, 'Module/') !== false) {
                if ($m != 6) return false;
                require_once o::app('module') . substr($class, $m + 6) . '.php';
                return true;
            } else
                return false;
        }
        );
        return $this;
    }

    //Include helpers functions
    function includeHelpers() {
        include __DIR__ . '/Helpers/functions.php';
        return $this;
    }

}
