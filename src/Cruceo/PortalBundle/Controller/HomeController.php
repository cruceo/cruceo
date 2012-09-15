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
     * @Template()
     */
    public function homeSearchAction()
    {
        $str      = $this->getRequest()->query->get('text');
        $start    = $this->getRequest()->query->get('start');
        $duration = $this->getRequest()->query->get('duration');
        $zone     = $this->getRequest()->query->get('zone');

        $results = $this->getDoctrine()->getRepository('CruceoPortalBundle:Cruceros')->searchHome(
            $str,
            $start,
            $duration,
            $zone
        );

        $companies  = $this->getDoctrine()->getRepository('CruceoPortalBundle:Navieras')->findAll();
        $cabins     = $this->getDoctrine()->getRepository('CruceoPortalBundle:Tipologias')->findAll();
        $categories = $this->getDoctrine()->getRepository('CruceoPortalBundle:Categorias')->findAll();
        $equipments = $this->getDoctrine()->getRepository('CruceoPortalBundle:Equipamientos')->findAll();


        $session = $this->get('session');
        $session->set('str', $str);
        $session->set('start', $start);
        $session->set('duration', $duration);
        $session->set('zone', $zone);

        return array(
            'results'    => $results,
            'companies'  => $companies,
            'cabins'     => $cabins,
            'categories' => $categories,
            'equipments' => $equipments
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