<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cruceo\PortalBundle\Entity\Tipologias;
use Cruceo\UserBundle\Form\TipologiasType;

/**
 * Tipologias controller.
 *
 */
class TipologiasController extends Controller
{
    /**
     * Lists all Tipologias entities.
     *
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:Tipologias')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Creates a new Tipologias entity.
     *
     * @Template()
     */
    public function newAction()
    {
        $entity  = new Tipologias();
        $form    = $this->createForm(new TipologiasType(), $entity);
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_tipologias'));
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Edits an existing Tipologias entity.
     *
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Tipologias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipologias entity.');
        }

        $editForm = $this->createForm(new TipologiasType(), $entity);
        $request  = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $editForm->bindRequest($request);

            if ($editForm->isValid()) {
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_tipologias'));
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
     * Deletes a Tipologias entity.
     *
     */
    public function deleteAction($id)
    {
        $form    = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em     = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CruceoPortalBundle:Tipologias')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tipologias entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_tipologias'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}
