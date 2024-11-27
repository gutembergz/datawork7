<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit306c1834bd4167c37bf98bd3178f3fa8
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPJasper\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPJasper\\' => 
        array (
            0 => __DIR__ . '/..' . '/geekcom/phpjasper/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit306c1834bd4167c37bf98bd3178f3fa8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit306c1834bd4167c37bf98bd3178f3fa8::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}