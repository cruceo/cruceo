<?php

namespace Cruceo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BarcosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion')
            ->add('naviera', 'entity', array(
                'class' => 'CruceoPortalBundle:Navieras',
                'empty_value' => 'Selecciona naviera...'
            ))
            ->add('categoria', 'entity', array(
                'class' => 'CruceoPortalBundle:Categorias',
                'empty_value' => 'Selecciona categoría...'
            ))
            ->add('velocidad')
            ->add('manga')
            ->add('eslora')
            ->add('equipamientos', 'entity', array(
                'class' => 'CruceoPortalBundle:Equipamientos',
                'expanded' => true,
                'multiple' => true
            ))
            ->add('fotos', 'collection', array(
                'type' =>  new FotosType(),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ));
        ;
    }

    public function getName()
    {
        return 'barcos';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Cruceo\PortalBundle\Entity\Barcos'
        );
    }
}
