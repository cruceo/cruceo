<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cruceo\PortalBundle\Entity\Navieras;
use Cruceo\UserBundle\Form\NavierasType;

/**
 * Navieras controller.
 *
 */
class NavierasController extends Controller
{
    /**
     * Lists all Navieras entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:Navieras')->findAll();

        return $this->render('CruceoUserBundle:Navieras:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Navieras entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Navieras')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Navieras entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CruceoUserBundle:Navieras:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Navieras entity.
     *
     */
    public function newAction()
    {
        $entity = new Navieras();
        $form   = $this->createForm(new NavierasType(), $entity);

        return $this->render('CruceoUserBundle:Navieras:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Navieras entity.
     *
     */
    public function createAction()
    {
        $entity  = new Navieras();
        $request = $this->getRequest();
        $form    = $this->createForm(new NavierasType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_navieras_show', array('id' => $entity->getId())));
            
        }

        return $this->render('CruceoUserBundle:Navieras:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Navieras entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Navieras')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Navieras entity.');
        }

        $editForm = $this->createForm(new NavierasType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CruceoUserBundle:Navieras:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Navieras entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Navieras')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Navieras entity.');
        }

        $editForm   = $this->createForm(new NavierasType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_navieras_edit', array('id' => $id)));
        }

        return $this->render('CruceoUserBundle:Navieras:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Navieras entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CruceoPortalBundle:Navieras')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Navieras entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_navieras'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
