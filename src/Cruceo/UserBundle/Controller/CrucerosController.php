<?php

namespace Cruceo\UserBundle\Controller;

use Cruceo\PortalBundle\Entity\Precios;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cruceo\PortalBundle\Entity\Cruceros;
use Cruceo\UserBundle\Form\CrucerosType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CrucerosController extends Controller
{
    /**
     * List all Cruceros entities
     *
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:Cruceros')->findAll();

        return array(
            'entities' => $entities
        );
    }

    /**
     * Create new Crucero
     *
     * @Template()
     */
    public function newAction()
    {
        $entity  = new Cruceros();
        $form    = $this->createForm(new CrucerosType(), $entity);
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_cruceros'));
            }
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Cruceros entity.
     *
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Cruceros')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cruceros entity.');
        }

        $editForm = $this->createForm(new CrucerosType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
			'entity'      => $entity,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Cruceros entity.
     *
     * @Template("CruceoUserBundle:Cruceros:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Cruceros')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cruceros entity.');
        }

        $originalPrices = array();
        $originalCities = array();

        foreach ($entity->getPrecios() as $precio) {
        	$originalPrices[] = $precio;
        }

        foreach ($entity->getCiudades() as $ciudad) {
            $originalCities[] = $ciudad;
        }

        $editForm   = $this->createForm(new CrucerosType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            foreach ($entity->getPrecios() as $precio) {
                foreach ($originalPrices as $key => $toDel) {
                    if ($toDel->getId() === $precio->getId()) {
                        unset($originalPrices[$key]);
                    }
                }
            }

            foreach ($originalPrices as $precio) {
                $em->remove($precio);
            }

            foreach ($entity->getCiudades() as $ciudad) {
                foreach ($originalCities as $key => $toDel) {
                    if ($toDel->getId() === $ciudad->getId()) {
                        unset($originalCities[$key]);
                    }
                }
            }

            foreach ($originalCities as $ciudad) {
                $em->remove($ciudad);
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_cruceros', array('id' => $id)));
        }

        return array(
			'entity'      => $entity,
            'form'   	  => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Cruceros entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CruceoPortalBundle:Cruceros')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cruceros entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_cruceros'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Remove image Itinerario
     *
     * @param string $img
     * @throws NotFoundHttpException
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteImageAction($img)
    {
        $request = $this->getRequest();

        if ($request->isXmlHttpRequest()) {
            $entity = $this->getDoctrine()->getEntityManager()->getRepository('CruceoPortalBundle:Cruceros')
                ->findOneByImgItinerario($img);

            if (null === $entity) {
                throw new NotFoundHttpException();
            }

            @unlink($entity->getUploadRootDir().DIRECTORY_SEPARATOR.$img);

            return new Response(json_encode(array('msg' => 'OK', 'image' => $img)));
        } else {
            throw new NotFoundHttpException();
        }
    }

    public function searchCitiesAction($country)
    {
        $request = $this->getRequest();

        if ($request->isXmlHttpRequest()) {
            $cities = $this->getDoctrine()->getEntityManager()->getRepository('CruceoPortalBundle:Ciudades')
                ->getAllCitiesByCountry($country);

            if (count($cities)) {
                $msg = $cities;
            } else {
                $msg = array('error' => 1, 'msg' => 'No existen ciudades para el país elegido');
            }


            return new Response(json_encode($msg));
        } else {
            throw new NotFoundHttpException();
        }
    }

    public function searchCountriesAction()
    {
        $request = $this->getRequest();
        $cities  = $request->request->get('cities');

        if ($request->isXmlHttpRequest() && is_array($cities)) {
            $countries = $this->getDoctrine()->getEntityManager()->getRepository('CruceoPortalBundle:Ciudades')
                ->getCountriesInCities($cities);

            return new Response(json_encode($countries));
        } else {
            throw new NotFoundHttpException();
        }
    }
}