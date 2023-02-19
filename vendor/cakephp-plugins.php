<?php
$baseDir = dirname(dirname(__FILE__));

return [
    'plugins' => [
        'ADmad/JwtAuth' => $baseDir . '/vendor/admad/cakephp-jwt-auth/',
        'Authentication' => $baseDir . '/vendor/cakephp/authentication/',
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'Cake/TwigView' => $baseDir . '/vendor/cakephp/twig-view/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Josegonzalez/Upload' => $baseDir . '/vendor/josegonzalez/cakephp-upload/',
        'Meta' => $baseDir . '/vendor/dereuromark/cakephp-meta/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'SocialShare' => $baseDir . '/vendor/drmonkeyninja/cakephp-social-share/',
    ],
];
