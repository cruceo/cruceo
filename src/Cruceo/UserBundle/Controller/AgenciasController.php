<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:Agencias')->findAll();

        return array(
            'entities' => $entities
        );
    }

    /**
     * Creates a new Agencias entity.
     *
     * @Template()
     */
    public function newAction()
    {
        $entity = new Agencias();
        $form   = $this->createForm(new AgenciasType(), $entity);
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_agencias'));
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Edits an existing Agencias entity.
     *
     * @Template()
     */
    public function editAction($id)
    {
        $em     = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CruceoPortalBundle:Agencias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Agencias entity.');
        }

        $request  = $this->getRequest();
        $editForm = $this->createForm(new AgenciasType(), $entity);

        if ('POST' === $request->getMethod()) {
            $editForm->bindRequest($request);

            if ($editForm->isValid()) {
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_agencias'));
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
