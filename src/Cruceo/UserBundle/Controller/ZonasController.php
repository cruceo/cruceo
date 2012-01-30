<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:Zonas')->findAll();

        return $this->render('CruceoUserBundle:Zonas:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Zonas entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Zonas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Zonas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CruceoUserBundle:Zonas:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Zonas entity.
     *
     */
    public function newAction()
    {
        $entity = new Zonas();
        $form   = $this->createForm(new ZonasType(), $entity);

        return $this->render('CruceoUserBundle:Zonas:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Zonas entity.
     *
     */
    public function createAction()
    {
        $entity  = new Zonas();
        $request = $this->getRequest();
        $form    = $this->createForm(new ZonasType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_zonas_show', array('id' => $entity->getId())));
            
        }

        return $this->render('CruceoUserBundle:Zonas:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Zonas entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Zonas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Zonas entity.');
        }

        $editForm = $this->createForm(new ZonasType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CruceoUserBundle:Zonas:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Zonas entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Zonas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Zonas entity.');
        }

        $editForm   = $this->createForm(new ZonasType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_zonas_edit', array('id' => $id)));
        }

        return $this->render('CruceoUserBundle:Zonas:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
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
