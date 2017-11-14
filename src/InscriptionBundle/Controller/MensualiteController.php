<?php

namespace InscriptionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MensualiteController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
}
