<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cruceo\PortalBundle\Entity\Ciudades;
use Cruceo\UserBundle\Form\CiudadesType;

/**
 * Ciudades controller.
 *
 */
class CiudadesController extends Controller
{
    /**
     * Lists all Ciudades entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:Ciudades')->findAll();

        return $this->render('CruceoUserBundle:Ciudades:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Ciudades entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Ciudades')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ciudades entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CruceoUserBundle:Ciudades:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Ciudades entity.
     *
     */
    public function newAction()
    {
        $entity = new Ciudades();
        $form   = $this->createForm(new CiudadesType(), $entity);

        return $this->render('CruceoUserBundle:Ciudades:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Ciudades entity.
     *
     */
    public function createAction()
    {
        $entity  = new Ciudades();
        $request = $this->getRequest();
        $form    = $this->createForm(new CiudadesType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_ciudades_show', array('id' => $entity->getId())));
            
        }

        return $this->render('CruceoUserBundle:Ciudades:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Ciudades entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Ciudades')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ciudades entity.');
        }

        $editForm = $this->createForm(new CiudadesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CruceoUserBundle:Ciudades:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Ciudades entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Ciudades')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ciudades entity.');
        }

        $editForm   = $this->createForm(new CiudadesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_ciudades_edit', array('id' => $id)));
        }

        return $this->render('CruceoUserBundle:Ciudades:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Ciudades entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CruceoPortalBundle:Ciudades')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ciudades entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_ciudades'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
