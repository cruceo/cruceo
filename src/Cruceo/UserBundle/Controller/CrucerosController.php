<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cruceo\PortalBundle\Entity\Cruceros;
use Cruceo\UserBundle\Form\CrucerosType;

class CrucerosController extends Controller
{
    /**
     * List all Cruceros entities
     *
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:Cruceros')->findAll();

        return $this->render('CruceoUserBundle:Cruceros:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Create new Crucero
     *
     * @Template()
     */
    public function newAction() {
        $cruise = new Cruceros();

        $form = $this->createForm(new CrucerosType(), $cruise);

        return array(
            'entity' => $cruise,
            'form' => $form->createView()
        );
    }
}
