<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitbcbbf0a7b711b47cef5007c7aa177fa8
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitbcbbf0a7b711b47cef5007c7aa177fa8', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitbcbbf0a7b711b47cef5007c7aa177fa8', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitbcbbf0a7b711b47cef5007c7aa177fa8::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
