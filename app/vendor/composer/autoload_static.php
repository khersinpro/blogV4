<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit47c01490b2e7dd59c04eaf538b8e4cc2
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit47c01490b2e7dd59c04eaf538b8e4cc2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit47c01490b2e7dd59c04eaf538b8e4cc2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit47c01490b2e7dd59c04eaf538b8e4cc2::$classMap;

        }, null, ClassLoader::class);
    }
}
