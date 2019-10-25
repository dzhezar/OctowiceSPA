<?php


namespace App\Form;


use App\DTO\EditCategoryDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditCategoryForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', IntegerType::class, [
                'label' => 'Минимальная цена',
                'required' => false,
            ])
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
                'required' => false,
            ])
            ->add('services', HiddenType::class)
            ->add('save', SubmitType::class, ['label' => 'Сохранить'])
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => EditCategoryDTO::class,
        ));
    }
}