<?php

namespace Cruceo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CiudadesCrucerosType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('pais', 'country', array(
                'property_path' => false,
                'empty_value' => 'Seleccione país...',
                'attr' => array(
                    'class' => 'searchCity'
                )
            ))
            ->add('ciudad', 'entity', array(
                'class' => 'CruceoPortalBundle:Ciudades',
                'empty_value' => 'Seleccione ciudad...',
                'attr' => array(
                    'class' => 'searchCountry'
                )
            ))
            /*->add('horaLlegada', 'time', array(
                'input'  => 'array',
                'widget' => 'choice'
            ))
            ->add('horaSalida', 'time', array(
                'input'  => 'array',
                'widget' => 'choice'
            ))*/
            ->add('horaLlegada')
            ->add('horaSalida')
            ->add('diaCrucero')
        ;
    }

    public function getName()
    {
        return 'ciudades_cruceros';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Cruceo\PortalBundle\Entity\CiudadesCruceros',
        );
    }
}
