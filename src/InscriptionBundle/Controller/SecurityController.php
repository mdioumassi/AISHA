<?php

namespace InscriptionBundle\Controller;

use InscriptionBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Controller\SecurityController as BaseController;

class SecurityController extends BaseController
{
    /**
     * Override FOS\UserBundle\Controller\SecurityController::renderLogin()
     * If user didn't login or user's login failed, then rendering to login page;
     * Else, if user is super admin, then rendering to BO dashboard;
     * Else, rendering to home page.
     *
     * @param array $data
     *
     * @return Response
     */
    protected function renderLogin(array $data)
    {
        $user = $this->getUser();

        if (!$user instanceof User || (isset($data['error']) && !empty($data['error']))) {
            return $this->render('@FOSUser/Security/login.html.twig', $data);
        }

        /*  if ($user->isSuperAdmin()) {
              return $this->redirectToRoute('sonata_admin_dashboard');
          }*/

        return $this->redirectToRoute('homepage');
    }
}
