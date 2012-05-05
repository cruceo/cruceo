<?php

namespace Cruceo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PreciosType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('precio', null,  array('attr' => array('class' => 'w250')))
            ->add('url', null,  array('attr' => array('class' => 'w250')))
            ->add('tipologia', 'entity', array(
                'class' => 'CruceoPortalBundle:Tipologias',
                'empty_value' => 'Selecciona tipo...'
            ))
            ->add('agencia', 'entity', array(
                'class' => 'CruceoPortalBundle:Agencias',
                'empty_value' => 'Selecciona Agencia...'
            ))
            ->add('fecha', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => array('class' => 'dp')
            ))
        ;
    }

    public function getName()
    {
        return 'precios';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Cruceo\PortalBundle\Entity\Precios'
        );
    }
}
