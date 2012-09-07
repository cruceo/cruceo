<?php

namespace Cruceo\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ShippingController extends Controller
{
    /**
     * @Template()
     */
    public function listAction()
    {
        $companies = $this->getDoctrine()->getRepository('CruceoPortalBundle:Navieras')->findAll();

        return array(
            'companies' => $companies
        );
    }

    /**
     * @Template()
     */
    public function detailAction($slug)
    {
        $entity = $this->getDoctrine()->getRepository('CruceoPortalBundle:Navieras')->getOneBySlug($slug);

        if (null === $entity) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
        }

        return array(
            'entity' => $entity
        );
    }
}