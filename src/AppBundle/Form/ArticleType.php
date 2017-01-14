<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;


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
      ->add('header_image',FileType::class,[
        'label'=> 'Upload header Image'
      ])
      ->add('content', CKEditorType::class,
          array(
            'config' => array(
              'uiColor' => '#7EA0B7',
            )
          )
        );
  }

}
