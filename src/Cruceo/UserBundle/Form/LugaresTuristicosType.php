<?php

namespace Cruceo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class LugaresTuristicosType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nombre', null,  array('attr' => array('class' => 'w250')))
            ->add('tiposLugares', 'entity', array(
                'class' => 'CruceoPortalBundle:TiposLugares',
                'empty_value' => 'Selecciona tipo de lugar...'
            ))
            ->add('descripcion', 'textarea')
        ;
    }

    public function getName()
    {
        return 'lugares_turisticos';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Cruceo\PortalBundle\Entity\LugaresTuristicos'
        );
    }
}
