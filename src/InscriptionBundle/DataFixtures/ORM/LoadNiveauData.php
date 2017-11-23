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
        $niv1->setClasse("Jardin")
             ->setDescription("Le jardin regroupe des enfants moins de 5 à 6 ans")
             ->setMensualite(1500);
        $manager->persist($niv1);

        $niv2 = new Niveau();
        $niv2->setClasse("Maternelle")
             ->setDescription("La maternelle regroupe des enfants moins de 3 à 4 ans")
             ->setMensualite(1000);
        $manager->persist($niv2);
        $manager->flush();

        $this->addReference("niv1", $niv1);
        $this->addReference("niv2", $niv2);
    }
}