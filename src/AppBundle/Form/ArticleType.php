<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('title',TextType::class, [
        'attr'=>[
            'class'=>'zougouloucata',
            'placeholder' => "Title of the article"
        ]
      ])
      ->add('header_image')
      ->add('author')
      ->add('content')
      ;
  }

}
