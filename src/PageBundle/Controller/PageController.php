<?php

namespace PageBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PageController extends Controller
{

    /**
     * @Route("/page/{id}", name="pages")
     */
    public function pageAction(Request $request){
        $page = $this->get('doctrine.orm.entity_manager')
                      ->getRepository('PageBundle:Page')
                      ->find($request->get('id'));
        if(null === $page){
            throw $this->createNotFoundException('Not Found');
        }

        return $this->render('@Page/Page/page.html.twig',[
            'page'=> $page
        ]);
    }
}
