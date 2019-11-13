<?php


namespace App\Form;


use App\DTO\CreateBlogDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateBlogForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Название (на русском)',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание (на русском)',
                'attr' => [
                    'class' => 'summernote'
                ]
            ])
            ->add('image', FileType::class,[
                'label' => 'Фото',
            ])
            ->add('seoTitle', TextType::class, [
                'label' => 'Сео тайтл',
                'required' => false,
            ])
            ->add('seoDescription', TextType::class, [
                'label' => 'Сео описание',
                'required' => false,
            ])

            ->add('save', SubmitType::class, ['label' => 'Добавить блог'])
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CreateBlogDto::class,
        ));
    }

}