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
            ->add('equipamiento', 'textarea')
            ->add('itinerario', 'textarea')
            ->add('imgItinerario', 'file')
            ->add('imgBarco', 'file')
            ->add('fechaSalida')
            ->add('promocion', 'textarea')
            ->add('incluidoPrecio', 'textarea')
            ->add('noIncluidoPrecio', 'textarea')
            ->add('naviera', 'entity', array(
                'class' => 'CruceoPortalBundle:Navieras',
                'empty_value' => 'Selecciona Naviera...'
            ))
            ->add('zona', 'entity', array(
                'class' => 'CruceoPortalBundle:Zonas',
                'empty_value' => 'Selecciona Zona...'
            ))
            /*->add('precios', 'collection', array(
                'type' =>  new PreciosType(),
                'allow_add' => true,
                'prototype' => true,
                'by_reference' => false,
            ));*/
            ->add('fotos', 'collection', array(
                'type' =>  new FotosType(),
                'allow_add' => true,
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
            'data_class' => 'Cruceo\PortalBundle\Entity\Cruceros'
        );
    }
}
