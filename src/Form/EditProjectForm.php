<?php


namespace App\Form;


use App\DTO\CategoryNameDTO;
use App\DTO\EditCategoryDTO;
use App\DTO\EditProjectDTO;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditProjectForm extends AbstractType
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
            ->add('link', TextType::class, [
                'label' => 'Ссылка портфолио',
                'required' => false
            ])
            ->add('image', FileType::class,[
                'label' => 'Главное изображение',
                'required' => false,
            ])
            ->add('category', ChoiceType::class,[
                'choices' => $options['categories'],
                'choice_label' => function(CategoryNameDTO $categoryNameDTO){
                    return $categoryNameDTO->getName();
                },
                'choice_value' => function(CategoryNameDTO $categoryNameDTO){
                    return $categoryNameDTO->getId();
                },
                'label' => 'Тип проекта'
            ])
            ->add('photos', FileType::class,[
                'label' => 'Изображения',
                'required' => false,
                'multiple' => true,
            ])
            ->add('save', SubmitType::class, ['label' => 'Сохранить'])
            ->getForm();
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => EditProjectDTO::class,
            'categories' => null
        ));
    }
}