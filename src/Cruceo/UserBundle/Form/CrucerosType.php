<?php
namespace Cruceo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CrucerosType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('detalles', 'textarea')
            ->add('itinerario', 'textarea')
            ->add('imgItinerarioFile', 'file')
            ->add('fechaSalida', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy'
            ))
            ->add('duracion')
            ->add('promocion', 'textarea')
            ->add('incluidoPrecio', 'textarea')
            ->add('noIncluidoPrecio', 'textarea')
            ->add('naviera', 'entity', array(
                'class' => 'CruceoPortalBundle:Navieras',
                'empty_value' => 'Selecciona Naviera...'
            ))
            ->add('barco', 'entity', array(
                'class' => 'CruceoPortalBundle:Barcos',
                'empty_value' => 'Selecciona Barco...'
            ))
            ->add('zona', 'entity', array(
                'class' => 'CruceoPortalBundle:Zonas',
                'empty_value' => 'Selecciona Zona...'
            ))
            /*->add('ciudades', 'entity', array(
                'class' => 'CruceoPortalBundle:Ciudades',
                'expanded' => true,
                'multiple' => true
            ))*/
            ->add('ciudades', 'collection', array(
                'type' =>  new CiudadesCrucerosType(),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ))
            ->add('precios', 'collection', array(
                'type' =>  new PreciosType(),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ));
        ;
    }

    public function getName()
    {
        return 'cruceros';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Cruceo\PortalBundle\Entity\Cruceros',
            'em'         => ''
        );
    }
}