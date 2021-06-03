<?php


namespace App\Form;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class Usertype extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
        $builder->add('firstName', TextType::class,[ 'attr' => [
                    'class' => 'form-control' ,


                  ]])

                ->add('lastName', TextType::class,['attr' => [
                    'class' => 'form-control' ,


                ]])
                ->add('photo' , FileType::class,['attr' => [
                    'class' => 'form-control' ,


                ]])
                ->add('email', EmailType::class,[
                    'attr' => [
                        'class' => 'form-control' ,

                ]])
                ->add('password', RepeatedType::class ,[
                    'type' => PasswordType::class,





                ])
                ->add('submit',SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-success pull-right'
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
//        parent::configureOptions($resolver); // TODO: Change the autogenerated stub
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }

}