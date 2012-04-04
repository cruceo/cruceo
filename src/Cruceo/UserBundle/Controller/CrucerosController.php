<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cruceo\PortalBundle\Entity\Cruceros;
use Cruceo\UserBundle\Form\CrucerosType;
use Symfony\Component\HttpFoundation\Response;

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

    public function savePhotoAction() {
    	$request = $this->getRequest();
    	$photo   = $request->files->get($request->request->get('name'));
    	$name    = uniqid().'.'.$photo->guessExtension();

    	$photo->move($this->container->getParameter('photos.upload'), $name);

    	$photos = $this->get('session')->get('photos') ?: array();
    	array_push($photos, $name);
    	$this->get('session')->remove('photos');

    	$this->get('session')->set('photos', $photos);

        return new Response(json_encode(array('msg' => $name)));
    }
}