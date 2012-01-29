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
            ->add('detalles')
            ->add('equipamiento')
            ->add('itinerario')
            ->add('imgItinerario')
            ->add('imgBarco')
            ->add('fechaSalida')
            ->add('promocion')
            ->add('incluidoPrecio')
            ->add('noIncluidoPrecio')
            ->add('naviera')
            ->add('zona')
        ;
    }

    public function getName()
    {
        return 'cruceros';
    }
}
