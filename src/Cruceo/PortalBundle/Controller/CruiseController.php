<?php

namespace Cruceo\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CruiseController extends Controller
{
    /**
     * @Template()
     */
    public function detailAction($slug)
    {
        $entity = $this->getDoctrine()->getRepository('CruceoPortalBundle:Cruceros')->getOneBySlug($slug);

        if (null === $entity) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
        }

        return array(
            'entity' => $entity
        );
    }
}