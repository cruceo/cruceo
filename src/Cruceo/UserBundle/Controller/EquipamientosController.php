<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cruceo\PortalBundle\Entity\Equipamientos;
use Cruceo\UserBundle\Form\EquipamientosType;

/**
 * Categorias controller.
 *
 */
class EquipamientosController extends Controller
{
    /**
     * Lists all Equipamientos entities.
     *
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:Equipamientos')->findAll();

        return array(
            'entities' => $entities
        );
    }

    /**
     * Creates a new Equipamientos entity.
     *
     * @Template()
     */
    public function newAction()
    {
        $entity = new Equipamientos();
        $form   = $this->createForm(new EquipamientosType(), $entity);
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
        	$form->bindRequest($request);

        	if ($form->isValid()) {
        		$em = $this->getDoctrine()->getEntityManager();
        		$em->persist($entity);
        		$em->flush();

        		return $this->redirect($this->generateUrl('admin_equipamientos'));
        	}
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Edits an existing Equipamientos entity.
     *
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Equipamientos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipamientos entity.');
        }

        $editForm = $this->createForm(new EquipamientosType(), $entity);
        $request  = $this->getRequest();

        if ('POST' === $request->getMethod()) {
        	$editForm->bindRequest($request);

        	if ($editForm->isValid()) {
        		$em->persist($entity);
        		$em->flush();

        		return $this->redirect($this->generateUrl('admin_equipamientos'));
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
     * Deletes a Equipamientos entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CruceoPortalBundle:Equipamientos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Equipamientos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_equipamientos'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
