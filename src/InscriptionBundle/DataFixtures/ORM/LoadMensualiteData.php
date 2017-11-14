<?php
/**
 * Created by PhpStorm.
 * User: mdioumassi
 * Date: 25/10/17
 * Time: 12:22
 */

namespace InscriptionBundle\DataFixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use InscriptionBundle\Entity\Mensualite;


class LoadMensualiteData extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $mois1 = new Mensualite();
        $mois1 ->setMois('Janvier')
               ->setPaye(1)
               ->setEnfant($this->getReference('enfant1'));
        $manager->persist($mois1);

        $mois2 = new Mensualite();
        $mois2 ->setMois('Février')
            ->setPaye(1)
            ->setEnfant($this->getReference('enfant2'));
        $manager->persist($mois2);
        $manager->flush();
    }

    public function  getDependencies()
    {
        return [
            LoadEnfantData::class
        ];
    }
}