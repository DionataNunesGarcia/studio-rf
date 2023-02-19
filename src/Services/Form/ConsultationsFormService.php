<?php

namespace App\Services\Form;

use App\Services\DefaultService;
use Cake\Controller\Controller;

class ConsultationsFormService extends DefaultService
{
    /**
     * @param Controller $controller
     */
    public function __construct(Controller $controller)
    {
        $this->setModel('Consultations');
        parent::__construct($controller);
    }
}
