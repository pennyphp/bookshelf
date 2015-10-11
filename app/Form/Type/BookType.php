<?php

namespace ClassicApp\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text');
        $builder->add('author', 'text');
        $builder->add('isbn', 'text');
        $builder->add('abstract', 'textarea');
        $builder->add('create', 'submit');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'ClassicApp\Entity\Book'
        ]);
    }

    public function getName()
    {
        return 'book';
    }
}