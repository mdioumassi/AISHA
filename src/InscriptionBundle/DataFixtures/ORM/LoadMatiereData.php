<?php
/**
 * Created by PhpStorm.
 * User: mdioumassi
 * Date: 25/10/17
 * Time: 14:33
 */

namespace InscriptionBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use InscriptionBundle\Entity\Matiere;

class LoadMatiereData extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $mat1 = new Matiere();
        $mat1->setLibelle("Arabe")
            ->setDescription("La langue arabe, est une langue de base de la religion")
            ->setCoefficient(5)
            ->setNiveau($this->getReference('niv1'));

        $manager->persist($mat1);
        $manager->flush();

        $this->addReference('mat1', $mat1);
    }

    public function getDependencies()
    {
        return [
           LoadNiveauData::class
        ];
    }
}
