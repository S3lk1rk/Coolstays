<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit6fdf2fc4bde0caf0b45ca67cea488b20
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

        spl_autoload_register(array('ComposerAutoloaderInit6fdf2fc4bde0caf0b45ca67cea488b20', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit6fdf2fc4bde0caf0b45ca67cea488b20', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit6fdf2fc4bde0caf0b45ca67cea488b20::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
