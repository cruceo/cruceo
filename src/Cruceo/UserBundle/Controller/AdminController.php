<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cruceo\UserBundle\Entity\BackUser;
use Cruceo\UserBundle\Form\CrucerosType;
use Symfony\Component\Security\Core\SecurityContext;

class AdminController extends Controller
{
    /**
     * Initial Action, only show menu
     *
     * @Template()
     */
    public function indexAction() {
        $user = $this->get('security.context')->getToken()->getUser()->getUserName();

        return array('user' => $user);
    }

    /**
     * Create new user
     *
     * @Template()
     */
    public function userAction() {
        $request = $this->getRequest();

        if ($request->getMethod() === 'POST') {
            $post     = $request->request->all();
            $factory  = $this->get('security.encoder_factory');
            $user     = new BackUser();
            $encoder  = $factory->getEncoder($user);
            $password = $encoder->encodePassword($post['password'], $user->getSalt());

            $user->setPassword($password);
            $user->setEmail($post['email']);
            $user->setUsername($post['username']);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($user);
            $em->flush();

            die('Guardao');
        }

        return array();
    }

    /**
     * Login Action
     *
     * @Template()
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
    }

    /**
     * The security layer will intercept this request
     */
    public function loginCheckAction() {}

    /**
     * The security layer will intercept this request
     */
    public function logoutAction() {}
}
