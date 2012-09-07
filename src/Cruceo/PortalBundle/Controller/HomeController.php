<?php

namespace Cruceo\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        $name = 'GOGOGOGO';
        return array('name' => $name);
    }

    /**
     * @Template()
     */
    public function searchAction()
    {
        $zones = $this->getDoctrine()->getRepository('CruceoPortalBundle:Zonas')->findAll();

        return array(
            'zones' => $zones
        );
    }

    /**
     * @Template()
     */
    public function highlightedAction()
    {
        $highlighted = $this->getDoctrine()->getRepository('CruceoPortalBundle:Cruceros')->getHighLighted();

        return array(
            'highlighteds' => $highlighted
        );
    }

    /**
     * @todo: crear mecanismo de guardado de busquedas (backend)
     *
     * @Template()
     */
    public function mostSearchedAction()
    {
    }
}