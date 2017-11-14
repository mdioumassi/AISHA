<?php
/**
 * Created by PhpStorm.
 * User: mdioumassi
 * Date: 25/10/17
 * Time: 15:30
 */

namespace InscriptionBundle\DataFixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use InscriptionBundle\Entity\Inscrit;

class LoadInscritData extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $insc1 = new Inscrit();
        $insc1->setEnfant($this->getReference('enfant1'))
              ->setNiveau($this->getReference('niv1'))
              ->setPaye(1)
              ->setFrais(500)
              ->setAnnee(2017);
        $manager->persist($insc1);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LoadEnfantData::class,
            LoadNiveauData::class
        ];
    }
}