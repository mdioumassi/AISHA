<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 22/10/17
 * Time: 20:02
 */

namespace InscriptionBundle\Twig;


class AishaExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('age', array($this, 'birthday'))
        );
    }

    public function birthday($dateNaiss)
    {
        $dateinterval = $dateNaiss->diff(new \DateTime("now"));
        return $dateinterval->y;
    }

    public function getName()
    {
        return 'aisha_extension';
    }
}