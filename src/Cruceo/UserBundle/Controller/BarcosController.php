<?php

namespace Cruceo\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Session;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cruceo\PortalBundle\Entity\Barcos;
use Cruceo\UserBundle\Form\BarcosType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Barcos controller.
 *
 */
class BarcosController extends Controller
{
    /**
     * Lists all Barcos entities.
     *
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CruceoPortalBundle:Barcos')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Displays a form to create a new Barcos entity.
     *
     * @Template()
     */
    public function newAction()
    {
        $this->get('session')->remove('photos');
        $entity = new Barcos();
        $form   = $this->createForm(new BarcosType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Barcos entity.
     *
     * @Template("CruceoUserBundle:Barcos:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Barcos();
        $request = $this->getRequest();
        $form    = $this->createForm(new BarcosType(), $entity);

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_barcos'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Barcos entity.
     *
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Barcos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Barcos entity.');
        }

        $editForm = $this->createForm(new BarcosType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Barcos entity.
     *
     * @Template("CruceoPortalBundle:Barcos:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CruceoPortalBundle:Barcos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Barcos entity.');
        }

        $originalPhotos = array();

        foreach ($entity->getFotos() as $photo) {
            $originalPhotos[] = $photo;
        }

        $editForm   = $this->createForm(new BarcosType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            foreach ($entity->getFotos() as $photo) {
                foreach ($originalPhotos as $key => $toDel) {
                    if ($toDel->getId() === $photo->getId()) {
                        unset($originalPhotos[$key]);
                    }
                }
            }

            foreach ($originalPhotos as $photo) {
                $em->remove($photo);
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_barcos'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Barcos entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CruceoPortalBundle:Barcos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Barcos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_barcos'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    /**
     * Remove photo
     *
     * @param string $img
     * @throws NotFoundHttpException
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deletePhotoAction($img) {
        $request = $this->getRequest();

        if ($request->isXmlHttpRequest()) {
            $entity = $this->getDoctrine()->getEntityManager()
                ->getRepository('CruceoPortalBundle:Barcos')->findOneByPhotoPath($img);

            if (null === $entity) {
                throw new NotFoundHttpException();
            }

            @unlink($entity->getUploadRootDir().DIRECTORY_SEPARATOR.$img);

            return new Response(json_encode(array('msg' => 'OK', 'image' => $img)));
        }
    }
}
