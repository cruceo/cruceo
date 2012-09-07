<?php

namespace Cruceo\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cruceo\PortalBundle\Lib\Util;

class ShipController extends Controller
{
    /**
     * @Template()
     */
    public function detailAction($slug)
    {
        $entity = $this->getDoctrine()->getRepository('CruceoPortalBundle:Barcos')->getOneBySlug($slug);

        if (null === $entity) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
        }

        Util::createThumbs($entity->getUploadRootDir(), $entity->getFotos());

        return array(
            'entity' => $entity
        );
    }
}