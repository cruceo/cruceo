<?php

namespace Cruceo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FotosType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('ruta', 'hidden')
            ->add('rutaFile', 'file', array(
                'required' => false
            ))
            ->add('titulo')

        ;
    }

    public function getName()
    {
        return 'fotos';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Cruceo\PortalBundle\Entity\Fotos'
        );
    }
}
