<?php


namespace App\Form;


use App\Entity\Locale;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateLocaleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Название',
            ])
            ->add('shortName', TextType::class, [
                'label' => 'Короткое имя языка (ru, en)',
            ])
            ->add('isShown', CheckboxType::class,[
                'label' => 'Отображать',
                'required' => false
            ])
            ->add('save', SubmitType::class, ['label' => 'Добавить язык'])
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Locale::class,
        ));
    }

}