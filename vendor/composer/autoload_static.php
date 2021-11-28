<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5cbf9446f25a0a677855ea11c21a01a6
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Alfred\\Workflows\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Alfred\\Workflows\\' => 
        array (
            0 => __DIR__ . '/..' . '/joetannenbaum/alfred-workflow/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5cbf9446f25a0a677855ea11c21a01a6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5cbf9446f25a0a677855ea11c21a01a6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5cbf9446f25a0a677855ea11c21a01a6::$classMap;

        }, null, ClassLoader::class);
    }
}
