<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cruceo\PortalBundle\Entity\Zonas;
use Cruceo\UserBundle\Form\ZonasType;

/**
 * Zonas controller.
 *
 */
class ZonasController extends Controller
{
    /**
     * Lists all Zonas entities.
     *
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:Zonas')->findAll();

        return array(
            'entities' => $entities
        );
    }

    /**
     * Creates a new Zonas entity.
     *
     * @Template()
     */
    public function newAction()
    {
        $entity = new Zonas();
        $form   = $this->createForm(new ZonasType(), $entity);
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
        	$form->bindRequest($request);

        	if ($form->isValid()) {
        		$em = $this->getDoctrine()->getEntityManager();
        		$em->persist($entity);
        		$em->flush();

        		return $this->redirect($this->generateUrl('admin_zonas'));
        	}
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Edits an existing Zonas entity.
     *
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Zonas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Zonas entity.');
        }

        $editForm = $this->createForm(new ZonasType(), $entity);

        $request  = $this->getRequest();

        if ('POST' === $request->getMethod()) {
        	$editForm->bindRequest($request);

        	if ($editForm->isValid()) {
        		$em->persist($entity);
        		$em->flush();

        		return $this->redirect($this->generateUrl('admin_zonas'));
        	}
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Zonas entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CruceoPortalBundle:Zonas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Zonas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_zonas'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
