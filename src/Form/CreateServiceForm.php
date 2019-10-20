<?php


namespace App\Form;


use App\DTO\CreateCategoryDTO;
use App\DTO\CreateServiceDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateServiceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Название (на русском)',
            ])
            ->add('description', TextType::class, [
                'label' => 'Описание (на русском)',
            ])
            ->add('price', IntegerType::class, [
                'label' => 'Минимальная цена',
                'required' => false,
            ])
            ->add('image', FileType::class,[
                'label' => 'Фото',
            ])

            ->add('save', SubmitType::class, ['label' => 'Добавить услугу'])
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CreateServiceDTO::class,
        ));
    }

}