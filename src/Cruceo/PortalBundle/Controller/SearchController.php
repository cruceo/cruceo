<?php

namespace Cruceo\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cruceo\PortalBundle\Lib\Util;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller
{
    public function advancedSearchAction()
    {
        $request = $this->getRequest();

        if ($request->isXmlHttpRequest() && 'POST' == $request->getMethod()) {
            $results = $this->getDoctrine()->getRepository('CruceoPortalBundle:Cruceros')->advancedSearch(
                $request->request->get('f-str'),
                $request->request->get('f-start'),
                $request->request->get('f-duration'),
                $request->request->get('f-zone'),
                $request->request->get('f-category'),
                $request->request->get('f-cabin'),
                $request->request->get('f-equipament'),
                $request->request->get('f-shipping')
            );

            return $this->render('CruceoPortalBundle:Partials:results.html.twig', array('results' => $results));

        } else {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
        }
    }
}