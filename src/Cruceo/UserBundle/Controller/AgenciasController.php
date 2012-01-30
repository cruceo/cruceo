<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cruceo\PortalBundle\Entity\Agencias;
use Cruceo\UserBundle\Form\AgenciasType;

/**
 * Agencias controller.
 *
 */
class AgenciasController extends Controller
{
    /**
     * Lists all Agencias entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:Agencias')->findAll();

        return $this->render('CruceoUserBundle:Agencias:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Agencias entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Agencias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agencias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CruceoUserBundle:Agencias:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Agencias entity.
     *
     */
    public function newAction()
    {
        $entity = new Agencias();
        $form   = $this->createForm(new AgenciasType(), $entity);

        return $this->render('CruceoUserBundle:Agencias:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Agencias entity.
     *
     */
    public function createAction()
    {
        $entity  = new Agencias();
        $request = $this->getRequest();
        $form    = $this->createForm(new AgenciasType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_agencias_show', array('id' => $entity->getId())));
            
        }

        return $this->render('CruceoUserBundle:Agencias:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Agencias entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Agencias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agencias entity.');
        }

        $editForm = $this->createForm(new AgenciasType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CruceoUserBundle:Agencias:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Agencias entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Agencias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agencias entity.');
        }

        $editForm   = $this->createForm(new AgenciasType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_agencias_edit', array('id' => $id)));
        }

        return $this->render('CruceoUserBundle:Agencias:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Agencias entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CruceoPortalBundle:Agencias')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Agencias entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_agencias'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
