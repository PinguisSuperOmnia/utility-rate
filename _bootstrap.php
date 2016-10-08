<?php
spl_autoload_register(function ($class) {
    if (stream_resolve_include_path($class . '.php')) {
        require_once $class . '.php';
    } else {
        $parts = explode('_', $class);
        if ($parts[0] === 'UtilityRate') {
            array_shift($parts);
            $path = implode('/', $parts) . '.php';
            require_once $path;
        }
    }
});
