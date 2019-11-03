<?php


namespace App\Form;


use App\DTO\EditCategoryTranslationDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditCategoryTranslationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Название',
            ])
            ->add('longDescription', TextType::class, [
                'label' => 'Длинное описание',
            ])
            ->add('shortDescription', TextType::class, [
                'label' => 'Короткое описание',
                'required' => false
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание',
            ])
            ->add('save', SubmitType::class, ['label' => 'Сохранить'])
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => EditCategoryTranslationDTO::class,
        ));
    }

}