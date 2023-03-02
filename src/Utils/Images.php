<?php

namespace App\Utils;

use App\Model\Entity\Upload;
use Cake\Routing\Router;

class Images
{
    /**
     * @param Upload|null $upload
     * @param string $default
     * @return string
     */
    public static function getImage(?Upload $upload, string $default = 'img/user-default.png') :string
    {
        $router = Router::url('/', true);
        if (!$upload) {
            return "{$router}{$default}";
        }
        return $router . 'Uploads' . DS . $upload->filename;
    }
}