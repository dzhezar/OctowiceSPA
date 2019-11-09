<?php


namespace App\Form;


use App\DTO\CreateCategoryDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateCategoryForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', IntegerType::class, [
                'label' => 'Минимальная цена',
                'required' => false,
            ])
            ->add('name', TextType::class, [
                'label' => 'Название (на русском)',
            ])
            ->add('longDescription', TextareaType::class, [
                'label' => 'Длинное описание',
            ])
            ->add('shortDescription', TextType::class, [
                'label' => 'Короткое описание',
                'required' => false,
            ])
            ->add('epigraph', TextareaType::class, [
                'label' => 'Описание под названием типа проекта',
                'required' => false,
            ])
            ->add('priceDescription', TextType::class, [
                'label' => 'Длительность выполнения проекта',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание на главной (на русском)',
            ])
            ->add('icon', FileType::class,[
                'label' => 'Иконка',
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
            ->add('services', HiddenType::class)

            ->add('save', SubmitType::class, ['label' => 'Добавить тип проекта'])
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CreateCategoryDTO::class,
        ));
    }
}