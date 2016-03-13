<?php

namespace JeroenED\CmsEDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use JeroenED\CmsEDBundle\Model\InitializableControllerInterface;
use JeroenED\CmsEDBundle\Initialize\Initializer;
use JeroenED\CmsEDBundle\Entity\User;

class DefaultController extends Controller implements InitializableControllerInterface 
{
    private $init;
    
    public function initialize( Request $request, TokenStorage $security_context) {
$kernel = $this->get('kernel');
        $dev = ($kernel->getEnvironment() == 'dev') ? true : false;
        $this->init['user'] = $this->getUser()->getUsername();
        $initializer = new Initializer();
        $parts = $initializer->getWebsiteParts();
        $route = $this->generateUrl($request->attributes->get('_route'));
        if ($dev) $route = explode('/app_dev.php', $route)[1];
        foreach ($parts as $key1 => $part1) {
            foreach($part1['parts'] as $key2 => $part2) {
                if($route == $part2['link']) {
                    $parts[$key1]['parts'][$key2]['active'] = true;
                }
            }
            if (stripos($route, $part1['link']) !== false) $this->init['uppernav'] = $parts[$key1]['parts'];
        }
        
        
        $this->init['leftnav'] = $parts;
    }
    /**
     * @Route("/admin"), name="admin_index"
     */
    public function adminAction()
    {
        return $this->render('JeroenEDCmsEDBundle:Default:index.html.twig', array('title' => 'Home', 'init' => $this->init));
    }
    /**
     * @Route("/admin/phpinfo"), name="phpinfo"
     */
    public function phpinfoAction()
    {
        ob_start();
        phpinfo();
        $theinfo = ob_get_contents();
        ob_get_clean();
        return $this->render('JeroenEDCmsEDBundle:Default:phpinfo.html.twig', array('info' => $theinfo));
    }
}
