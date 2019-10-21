<?php


namespace App\Form;


use App\DTO\EditServiceDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditServiceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', IntegerType::class, [
                'label' => 'Минимальная цена',
                'required' => false,
            ])
            ->add('image', FileType::class,[
                'label' => 'Фото',
                'required' => false
            ])
            ->add('isOnServicePage', CheckboxType::class,[
                'label' => 'Отображать на странице доп. услуг',
                'required' => false
            ])

            ->add('save', SubmitType::class, ['label' => 'Сохранить'])
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => EditServiceDTO::class,
        ));
    }

}