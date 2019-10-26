<?php


namespace App\Form;


use App\DTO\EditBlogDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditBlogForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('seoTitle', TextType::class, [
                'label' => 'Сео тайтл',
                'required' => false,
            ])
            ->add('seoDescription', TextType::class, [
                'label' => 'Сео описание',
                'required' => false,
            ])

            ->add('image', FileType::class,[
                'label' => 'Фото',
                'required' => false
            ])

            ->add('save', SubmitType::class, ['label' => 'Сохранить'])
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => EditBlogDTO::class,
        ));
    }

}