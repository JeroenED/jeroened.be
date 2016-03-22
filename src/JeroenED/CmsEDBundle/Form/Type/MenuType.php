<?php

namespace JeroenED\CmsEDBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

/**
 * Description of MenuType
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class MenuType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('label', TextType::class, array('label' => 'Label'));
        $builder->add('destination', TextType::class, array('label' => 'Destination'));
        $builder->add('rank', IntegerType::class, array('label' => 'Rank'));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'JeroenED\PortfolioBundle\Entity\MenuItem',
            'error_bubbling' => true
        ));
    }

    public function getName() {
        return 'Menu';
    }
    
}
