<?php
/**
 * Boostrapping and common utility definition.
 */
define('XHGUI_ROOT_DIR', dirname(__DIR__));

if (file_exists(XHGUI_ROOT_DIR . '/vendor/autoload.php')) {
    require XHGUI_ROOT_DIR . '/vendor/autoload.php';
} elseif (file_exists(XHGUI_ROOT_DIR . '/../../autoload.php')) {
    require XHGUI_ROOT_DIR . '/../../autoload.php';
}

// FindTheBest Modifications
//  Register autoload callback for Mongofill submodule.
if (defined('HHVM_VERSION')) {
    spl_autoload_register(function ($class_name) {
        $class_name = str_replace('Mongofill\\', 'Mongofill/', $class_name);
        if (file_exists(XHGUI_ROOT_DIR . "/../mongofill/src/{$class_name}.php")) {
            require_once XHGUI_ROOT_DIR . "/../mongofill/src/{$class_name}.php";
            return true;
        }
        return false;
    });
}

Xhgui_Config::load(XHGUI_ROOT_DIR . '/config/config.default.php');
if (file_exists(XHGUI_ROOT_DIR . '/config/config.php')) {
    Xhgui_Config::load(XHGUI_ROOT_DIR . '/config/config.php');
}
