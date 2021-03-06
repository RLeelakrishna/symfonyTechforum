<?php


namespace App\Form;


use App\Entity\Answers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditAnswer extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
        $builder
            ->add('description', TextareaType::class)
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success pull-right'
                ]
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
//        parent::configureOptions($resolver); // TODO: Change the autogenerated stub
        $resolver->setDefaults([
            'data_class' => Answers::class
        ]);
    }



}