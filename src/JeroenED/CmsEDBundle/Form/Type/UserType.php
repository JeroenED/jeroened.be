<?php

namespace JeroenED\CmsEDBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

/**
 * Description of UserType
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class UserType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('userName', TextType::Class, array('label' => 'Username'));
        $builder->add('email', EmailType::Class, array('label' => 'E-mail'));
        $builder->add('isActive', CheckboxType::Class, array('label' => 'Account active',  'required' => false));
        $builder->add('googleAuthenticatorSecret', TextType::Class, array('label' => '2-factor key', 'required' => false, 'attr' => array('class' => '2factor')));
        $builder->add('password', RepeatedType::Class, array(
            'type' => PasswordType::Class,
            'invalid_message' => 'The password fields must match.',
            'first_options' => array('label' => 'Password'),
            'second_options' => array('label' => 'Repeat password')
        ));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'JeroenED\CmsEDBundle\Entity\User',
            'error_bubbling' => true
        ));
    }

    public function getName() {
        return 'user';
    }
    
}
