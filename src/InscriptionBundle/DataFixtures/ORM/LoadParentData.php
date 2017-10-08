<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 04/10/17
 * Time: 18:59
 */

namespace InscriptionBundle\DataFixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use InscriptionBundle\Entity\Parents;

class LoadParentData extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $parent1 = new Parents();
        $parent1->setNom("DIOUMASSI")
                ->setPrenom("Mohamed")
                ->setCivilite("Monsieur")
                ->setFonction("Informaticien")
                ->setTelephone("0602732975")
                ->setAddresse("France");
        $manager->persist($parent1);
        $manager->flush();
        $this->addReference('parent1', $parent1);
    }

}