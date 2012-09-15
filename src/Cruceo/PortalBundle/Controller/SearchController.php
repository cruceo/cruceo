<?php

namespace Cruceo\PortalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cruceo\PortalBundle\Lib\Util;

class SearchController extends Controller
{
    /**
     * @Template()
     */
    public function advancedSearch()
    {
        $request = $this->getRequest();

        if ($request->isXmlHttpRequest() && 'POST' == $request->getMethod()) {
            $this->getDoctrine()->getRepository('CruceoPortalBundle:Cruceros')->advancedSearch();
        } else {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
        }
    }
}