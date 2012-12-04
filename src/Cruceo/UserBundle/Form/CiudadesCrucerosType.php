<?php

namespace Cruceo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class CiudadesCrucerosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
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
                'class'         => 'CruceoPortalBundle:Ciudades',
                'empty_value'   => 'Seleccione ciudad...',
                /*'query_builder' => function(EntityRepository $er) use ($builder) {
                    die(var_dump($builder->getData()));
                    return $er->createQueryBuilder('c')
                        ->setMaxResults(10)
                        ->orderBy('c.nombre', 'ASC');
                },*/
                'attr' => array(
                    'class' => 'searchCountry'
                )
            ))
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
