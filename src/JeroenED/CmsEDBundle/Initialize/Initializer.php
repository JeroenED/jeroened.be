<?php

namespace JeroenED\CmsEDBundle\Initialize;

/**
 * Description of Initialize
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class Initializer {
    private $websiteParts = array(
        array('label' => 'Home', 'link' => '/admin', 'parts' => array()),
        array('label' => 'Portfolio', 'link' => '/admin/portfolio', 'parts' => array(array('label' => 'List', 'link' => '/admin/portfolio'), array('label' => 'Create new', 'link' => '/admin/portfolio/create'))),
        array('label' => 'Pages', 'link' => '/admin/pages', 'parts' => array(array('label' => 'List', 'link' => '/admin/pages'), array('label' => 'Create new', 'link' => '/admin/pages/create'))),
        array('label' => 'Menu', 'link' => '/admin/menu', 'parts' => array(array('label' => 'List', 'link' => '/admin/menu'), array('label' => 'Create new', 'link' => '/admin/menu/create'))),
        array('label' => 'Users', 'link' => '/admin/users', 'parts' => array(array('label' => 'List', 'link' => '/admin/users'), array('label' => 'Create new', 'link' => '/admin/users/create'))),
    );
    
    public function getWebsiteParts() {
        return $this->websiteParts;
    }
}
