<?php
namespace JeroenED\CmsEDBundle\Initialize;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of Initialize
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class Initializer extends Controller {
    private $websiteParts = array(
        array('label' => 'Home', 'link' => '/admin', 'parts' => array()),
        array('label' => 'Portfolio', 'link' => '/admin/portfolio', 'parts' => array(array('label' => 'List', 'link' => '/admin/portfolio'), array('label' => 'Archive', 'link' => '/admin/portfolio/archive'), array('label' => 'Create new', 'link' => '/admin/portfolio/create'))),
        array('label' => 'Pages', 'link' => '/admin/pages', 'parts' => array(array('label' => 'List', 'link' => '/admin/pages'), array('label' => 'Create new', 'link' => '/admin/pages/create'))),
        array('label' => 'Menu', 'link' => '/admin/menu', 'parts' => array(array('label' => 'List', 'link' => '/admin/menu'), array('label' => 'Create new', 'link' => '/admin/menu/create'))),
        array('label' => 'Users', 'link' => '/admin/users', 'parts' => array(array('label' => 'List', 'link' => '/admin/users'), array('label' => 'Create new', 'link' => '/admin/users/create'))),
    );
    
    public function getWebsiteParts() {
        return $this->websiteParts;
    }
	
    public function getMenus(Request $request) {
        $parts = $this->getWebsiteParts();
		$route = $_SERVER['REQUEST_URI'];
        foreach ($parts as $key1 => $part1) {
            foreach($part1['parts'] as $key2 => $part2) {
                if($route == $part2['link']) {
                    $parts[$key1]['parts'][$key2]['active'] = true;
                }
            }
            if (stripos($route, $part1['link']) !== false) $menu['uppernav'] = $parts[$key1]['parts'];
        }
        
        
        $menu['leftnav'] = $parts;
        return $menu;
    }
	
}
