<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:Categorias')->findAll();

        return array(
            'entities' => $entities
        );
    }

    /**
     * Creates a new Categorias entity.
     *
     * @Template()
     */
    public function newAction()
    {
        $entity = new Categorias();
        $form   = $this->createForm(new CategoriasType(), $entity);
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
        	$form->bindRequest($request);

        	if ($form->isValid()) {
        		$em = $this->getDoctrine()->getEntityManager();
        		$em->persist($entity);
        		$em->flush();

        		return $this->redirect($this->generateUrl('admin_categorias'));
        	}
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Edits an existing Categorias entity.
     *
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Categorias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categorias entity.');
        }

        $editForm = $this->createForm(new CategoriasType(), $entity);
        $request  = $this->getRequest();

        if ('POST' === $request->getMethod()) {
        	$editForm->bindRequest($request);

        	if ($editForm->isValid()) {
        		$em->persist($entity);
        		$em->flush();

        		return $this->redirect($this->generateUrl('admin_categorias'));
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
