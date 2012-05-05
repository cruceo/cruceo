<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:Ciudades')->findAll();

        return array(
            'entities' => $entities
        );
    }

    /**
     * Creates a new Ciudades entity.
     *
     * @Template()
     */
    public function newAction()
    {
        $entity = new Ciudades();
        $form   = $this->createForm(new CiudadesType(), $entity);
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
        	$form->bindRequest($request);

        	if ($form->isValid()) {
        		$em = $this->getDoctrine()->getEntityManager();
        		$em->persist($entity);
        		$em->flush();

        		return $this->redirect($this->generateUrl('admin_ciudades'));
        	}
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Edits an existing Ciudades entity.
     *
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Ciudades')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ciudades entity.');
        }

        $editForm = $this->createForm(new CiudadesType(), $entity);
        $request  = $this->getRequest();

        if ('POST' === $request->getMethod()) {
        	$editForm->bindRequest($request);

        	if ($editForm->isValid()) {
        		$em->persist($entity);
        		$em->flush();

        		return $this->redirect($this->generateUrl('admin_ciudades'));
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
