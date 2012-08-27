<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cruceo\PortalBundle\Entity\TiposLugares;
use Cruceo\UserBundle\Form\TiposLugaresType;

/**
 * Categorias controller.
 *
 */
class TiposLugaresController extends Controller
{
    /**
     * Lists all TiposLugares entities.
     *
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:TiposLugares')->findAll();

        return array(
            'entities' => $entities
        );
    }

    /**
     * Creates a new TiposLugares entity.
     *
     * @Template()
     */
    public function newAction()
    {
        $entity = new TiposLugares();
        $form   = $this->createForm(new TiposLugaresType(), $entity);
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
        	$form->bindRequest($request);

        	if ($form->isValid()) {
        		$em = $this->getDoctrine()->getEntityManager();
        		$em->persist($entity);
        		$em->flush();

        		return $this->redirect($this->generateUrl('admin_tipos_lugares'));
        	}
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Edits an existing TiposLugares entity.
     *
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:TiposLugares')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TiposLugares entity.');
        }

        $editForm = $this->createForm(new TiposLugaresType(), $entity);
        $request  = $this->getRequest();

        if ('POST' === $request->getMethod()) {
        	$editForm->bindRequest($request);

        	if ($editForm->isValid()) {
        		$em->persist($entity);
        		$em->flush();

        		return $this->redirect($this->generateUrl('admin_tipos_lugares'));
        	}
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'		  => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a TiposLugares entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CruceoPortalBundle:TiposLugares')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TiposLugares entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_tipos_lugares'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
