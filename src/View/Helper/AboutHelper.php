<?php

namespace App\View\Helper;
use App\Model\Entity\About;
use Cake\View\Helper;
use Cake\View\View;
use Cake\ORM\TableRegistry;

class AboutHelper extends Helper {

    /**
     * @return About
     */
    public function get() :About
    {
        /** @var About $about */
        $about = TableRegistry::getTableLocator()
            ->get('About')
            ->getEntity();

        return $about;
    }

    /**
     * @return array
     */
    public function banners() :array
    {
        return TableRegistry::getTableLocator()
            ->get('Uploads')
            ->find()
            ->where([
                'model' => 'Banners'
            ])
            ->toArray();
    }
}
