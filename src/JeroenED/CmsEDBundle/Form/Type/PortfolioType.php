<?php

namespace JeroenED\CmsEDBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

/**
 * Description of MenuType
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class PortfolioType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('title', TextType::class, array('label' => 'Title'));
        $builder->add('rank', HiddenType::class);
        $builder->add('pages', HiddenType::class);
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'JeroenED\PortfolioBundle\Entity\PortfolioItem',
            'error_bubbling' => true
        ));
    }

    public function getName() {
        return 'Portfolio';
    }
    
}
