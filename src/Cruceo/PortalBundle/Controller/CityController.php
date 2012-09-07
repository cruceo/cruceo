<?php

namespace Cruceo\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cruceo\PortalBundle\Lib\Util;

class CityController extends Controller
{
    /**
     * @Template()
     */
    public function detailAction($slug)
    {
        $entity = $this->getDoctrine()->getRepository('CruceoPortalBundle:Ciudades')->getOneBySlug($slug);

        if (null === $entity) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
        }

        return array(
            'entity' => $entity
        );
    }
}