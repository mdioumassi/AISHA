<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 30/09/17
 * Time: 16:19
 */
namespace PageBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PageBundle\Entity\Page;

class LoadPageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $page1 = new Page();
        $page1->setTitre("L'association AISHA");
        $page1->setContenu("L’association pour la Promotion de la Mère et de l’Enfant au Guidimakha est une association créée dans le soucis de contribuer au développement de la région par l’action participative des populations ,notamment les femmes et les jeunes.
                    Elle est reconnue par récépissé n° 0163 / MIPT/DAPLP/SLP en date du 21 Août 2001. Son action est illimitée. Elle a pour objectifs : L’éducation, la Protection Sanitaire et la préservation de l'environnement");
        $manager->persist($page1);

        $page2 = new Page();
        $page2->setTitre("Nos réalisations");
        $page2->setContenu("
                        Item Brand and Category AB29837 Item Model orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                        Item Brand and Category stry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                        ");
        $manager->persist($page2);

        $page3 = new Page();
        $page3->setTitre("Nos réalisations");
        $page3->setContenu("
                        Item Brand and Category AB29837 Item Model orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                        Item Brand and Category stry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                        ");
        $manager->persist($page3);
        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}
