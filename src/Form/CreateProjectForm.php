<?php


namespace App\Form;


use App\DTO\CategoryNameDTO;
use App\DTO\CreateProjectDTO;
use App\DTO\EditProjectDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateProjectForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Название (на русском)',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание (на русском)',
            ])
            ->add('seoTitle', TextType::class, [
                'label' => 'Сео тайтл',
                'required' => false,
            ])
            ->add('seoDescription', TextType::class, [
                'label' => 'Сео описание',
                'required' => false,
            ])
            ->add('link', TextType::class, [
                'label' => 'Ссылка портфолио',
                'required' => false
            ])
            ->add('image', FileType::class,[
                'label' => 'Главное изображение',
            ])
            ->add('category', ChoiceType::class,[
                'choices' => $options['categories'],
                'choice_label' => function(CategoryNameDTO $categoryNameDTO){
                    return $categoryNameDTO->getName();
                },
                'label' => 'Тип проекта'
            ])
            ->add('save', SubmitType::class, ['label' => 'Добавить портфолио'])
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CreateProjectDTO::class,
            'categories' => null
        ));
    }
}