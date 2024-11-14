<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6f91d543d556a22cb92b9ae8545b7c29
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Templately\\' => 11,
        ),
        'P' => 
        array (
            'PriyoMukul\\WPNotice\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Templately\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
        'PriyoMukul\\WPNotice\\' => 
        array (
            0 => __DIR__ . '/..' . '/priyomukul/wp-notice/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6f91d543d556a22cb92b9ae8545b7c29::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6f91d543d556a22cb92b9ae8545b7c29::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6f91d543d556a22cb92b9ae8545b7c29::$classMap;

        }, null, ClassLoader::class);
    }
}