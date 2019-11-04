<?php


namespace App\Form;


use App\DTO\CreateProjectBlockDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateProjectBlock extends AbstractType
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
            ->add('color', HiddenType::class, [
                'label' => 'Цвет Фона',
            ])
            ->add('colorText', HiddenType::class, [
                'label' => 'Цвет текста',
            ])
            ->add('image', FileType::class,[
                'label' => 'Фото',
                'required' => false
            ])

            ->add('save', SubmitType::class, ['label' => 'Добавить блок'])
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreateProjectBlockDTO::class,
        ]);
    }

}