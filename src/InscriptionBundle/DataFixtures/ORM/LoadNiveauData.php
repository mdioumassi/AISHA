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
use InscriptionBundle\Entity\Niveau;

class LoadNiveauData extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $niv1 = new Niveau();
        $niv1->setNom("Jardin")
             ->setDescription("Le jardin regroupe des enfants moins de 5 à 6 ans")
             ->addMatiere($this->getReference('mat1'));
        $manager->persist($niv1);

        $niv2 = new Niveau();
        $niv2->setNom("Maternelle")
            ->setDescription("La maternelle regroupe des enfants moins de 3 à 4 ans");
        $manager->persist($niv2);
        $manager->flush();

        $this->addReference("niv1", $niv1);
        $this->addReference("niv2", $niv2);
    }

    public function  getDependencies()
    {
        return [
            LoadMatiereData::class
        ];
    }
}