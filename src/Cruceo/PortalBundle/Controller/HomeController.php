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
        return array();
    }

    /**
     * @Template()
     */
    public function homeSearchAction()
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
    public function searchAction()
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

        if (count($results)) {
            $this->generateMostWanted($str);
        }

        $companies  = $this->getDoctrine()->getRepository('CruceoPortalBundle:Navieras')->findAll();
        $cabins     = $this->getDoctrine()->getRepository('CruceoPortalBundle:Tipologias')->findAll();
        $categories = $this->getDoctrine()->getRepository('CruceoPortalBundle:Categorias')->findAll();
        $equipments = $this->getDoctrine()->getRepository('CruceoPortalBundle:Equipamientos')->findAll();

        $session = $this->get('session');
        $session->setFlash('str', $str);
        $session->setFlash('start', $start);
        $session->setFlash('duration', $duration);
        $session->setFlash('zone', $zone);

        $data = array(
            'str'      => $str,
            'start'    => $start,
            'duration' => $duration,
            'zone'     => $zone
        );

        return array(
            'results'    => $results,
            'companies'  => $companies,
            'cabins'     => $cabins,
            'categories' => $categories,
            'equipments' => $equipments,
            'data'       => $data
        );
    }

    /**
     * @Template()
     */
    public function mostWantedAction()
    {
        $results = $this->getDoctrine()->getRepository('CruceoPortalBundle:Searched')->get;


    }

    private function generateMostWanted($str)
    {
        $entity = new \Cruceo\PortalBundle\Entity\Searched();
        $entity->setSearch($str);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }
}