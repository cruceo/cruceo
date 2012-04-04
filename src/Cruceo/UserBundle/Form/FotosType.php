<?php

namespace Cruceo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FotosType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('file', 'file', array('attr' => array('class' => 'jxaz')))
            ->add('titulo')

        ;
    }

    public function getName()
    {
        return 'cruceo_portalbundle_fotostype';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Cruceo\PortalBundle\Entity\Fotos'
        );
    }
}
