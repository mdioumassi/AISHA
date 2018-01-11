<?php

namespace InscriptionBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class InscriptionBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
