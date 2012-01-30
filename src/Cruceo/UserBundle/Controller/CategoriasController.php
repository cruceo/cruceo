<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cruceo\PortalBundle\Entity\Categorias;
use Cruceo\UserBundle\Form\CategoriasType;

/**
 * Categorias controller.
 *
 */
class CategoriasController extends Controller
{
    /**
     * Lists all Categorias entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:Categorias')->findAll();

        return $this->render('CruceoUserBundle:Categorias:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Categorias entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Categorias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categorias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CruceoUserBundle:Categorias:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Categorias entity.
     *
     */
    public function newAction()
    {
        $entity = new Categorias();
        $form   = $this->createForm(new CategoriasType(), $entity);

        return $this->render('CruceoUserBundle:Categorias:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Categorias entity.
     *
     */
    public function createAction()
    {
        $entity  = new Categorias();
        $request = $this->getRequest();
        $form    = $this->createForm(new CategoriasType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_categorias_show', array('id' => $entity->getId())));
            
        }

        return $this->render('CruceoUserBundle:Categorias:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Categorias entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Categorias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categorias entity.');
        }

        $editForm = $this->createForm(new CategoriasType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CruceoUserBundle:Categorias:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Categorias entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Categorias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categorias entity.');
        }

        $editForm   = $this->createForm(new CategoriasType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_categorias_edit', array('id' => $id)));
        }

        return $this->render('CruceoUserBundle:Categorias:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Categorias entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CruceoPortalBundle:Categorias')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Categorias entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_categorias'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
