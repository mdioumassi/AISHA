<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 04/10/17
 * Time: 19:05
 */

namespace InscriptionBundle\DataFixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use InscriptionBundle\Entity\Enfant;

class LoadEnfantData extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $enfant1 = new Enfant();
        $enfant1->setNom("DIOUMASSI")
                ->setPrenom("Diango")
                ->setGenre("Garçon")
                ->setDateNaissance(new \DateTime("now"))
                ->setParent($this->getReference('parent1'))
                ->setNiveau($this->getReference('niv1'));
        $manager->persist($enfant1);

        $enfant2 = new Enfant();
        $enfant2->setNom("DIOUMASSI")
                ->setPrenom("Fatima")
                ->setGenre("Fille")
                ->setDateNaissance(new \DateTime("now"))
                ->setParent($this->getReference('parent1'))
                ->setNiveau($this->getReference('niv1'));
        $manager->persist($enfant2);

        $enfant3 = new Enfant();
        $enfant3->setNom("DIOUMASSI")
            ->setPrenom("Oyoub")
            ->setGenre("Garçon")
            ->setDateNaissance(new \DateTime("now"))
            ->setParent($this->getReference('parent1'))
            ->setNiveau($this->getReference('niv2'));
        $manager->persist($enfant3);

        $manager->flush();

    }


    public function getDependencies()
    {
        return [
            LoadParentData::class,
            LoadNiveauData::class
        ];
    }
}