<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8b51e36ceca1e7fa191e2f68622e3555
{
    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/src',
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Parsedown' => 
            array (
                0 => __DIR__ . '/..' . '/erusev/parsedown',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr4 = ComposerStaticInit8b51e36ceca1e7fa191e2f68622e3555::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit8b51e36ceca1e7fa191e2f68622e3555::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}