<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitef6a35b6f90742bddb69f0b2880100bf
{
    public static $files = array (
        'ad155f8f1cf0d418fe49e248db8c661b' => __DIR__ . '/..' . '/react/promise/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tests\\' => 6,
        ),
        'S' => 
        array (
            'SpotifyWebAPI\\' => 14,
        ),
        'R' => 
        array (
            'React\\Promise\\' => 14,
        ),
        'M' => 
        array (
            'Madcoda\\Youtube\\' => 16,
        ),
        'L' => 
        array (
            'LastFmApi\\' => 10,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Subscriber\\Oauth\\' => 28,
            'GuzzleHttp\\Stream\\' => 18,
            'GuzzleHttp\\Ring\\' => 16,
            'GuzzleHttp\\Command\\Guzzle\\' => 26,
            'GuzzleHttp\\Command\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/matto1990/lastfm-api/tests',
        ),
        'SpotifyWebAPI\\' => 
        array (
            0 => __DIR__ . '/..' . '/jwilsson/spotify-web-api-php/src',
        ),
        'React\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/promise/src',
        ),
        'Madcoda\\Youtube\\' => 
        array (
            0 => __DIR__ . '/..' . '/madcoda/php-youtube-api/src',
        ),
        'LastFmApi\\' => 
        array (
            0 => __DIR__ . '/..' . '/matto1990/lastfm-api/src/lastfmapi',
        ),
        'GuzzleHttp\\Subscriber\\Oauth\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/oauth-subscriber/src',
        ),
        'GuzzleHttp\\Stream\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/streams/src',
        ),
        'GuzzleHttp\\Ring\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/ringphp/src',
        ),
        'GuzzleHttp\\Command\\Guzzle\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle-services/src',
        ),
        'GuzzleHttp\\Command\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/command/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'D' => 
        array (
            'Discogs' => 
            array (
                0 => __DIR__ . '/..' . '/ricbra/php-discogs-api/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Madcoda\\compat' => __DIR__ . '/..' . '/madcoda/php-youtube-api/src/compat.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitef6a35b6f90742bddb69f0b2880100bf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitef6a35b6f90742bddb69f0b2880100bf::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitef6a35b6f90742bddb69f0b2880100bf::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitef6a35b6f90742bddb69f0b2880100bf::$classMap;

        }, null, ClassLoader::class);
    }
}
