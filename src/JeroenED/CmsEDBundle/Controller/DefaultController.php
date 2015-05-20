<?php

namespace JeroenED\CmsEDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use JeroenED\CmsEDBundle\Model\InitializableControllerInterface;
use JeroenED\CmsEDBundle\Entity\User;

class DefaultController extends Controller implements InitializableControllerInterface 
{
    private $init;
    
    public function initialize( Request $request, SecurityContextInterface $security_context) {
        $this->init['user'] = $this->getUser()->getUsername();
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
