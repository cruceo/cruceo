<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cruceo\PortalBundle\Entity\Navieras;
use Cruceo\UserBundle\Form\NavierasType;
use Cruceo\PortalBundle\Lib\Util;

/**
 * Navieras controller.
 *
 * @Template()
 */
class NavierasController extends Controller
{
    /**
     * Lists all Navieras entities.
     *
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:Navieras')->findAll();

        return array(
            'entities' => $entities
        );
    }

    /**
     * Creates a new Navieras entity.
     *
     * @Template()
     */
    public function newAction()
    {
        $entity  = new Navieras();
        $form    = $this->createForm(new NavierasType(), $entity);
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_navieras'));
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Edits an existing Navieras entity.
     *
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Navieras')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Navieras entity.');
        }

        $editForm = $this->createForm(new NavierasType(), $entity);

        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $editForm->bindRequest($request);

            if ($editForm->isValid()) {
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('admin_navieras'));
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
     * Deletes a Navieras entity.
     *
     */
    public function deleteAction($id)
    {
        $form    = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em     = $this->getDoctrine()->getEntityManager();
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
            ->getForm();
    }
}
