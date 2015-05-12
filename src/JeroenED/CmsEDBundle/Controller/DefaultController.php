<?php

namespace JeroenED\CmsEDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/admin"), name="admin_index"
     */
    public function adminAction()
    {
        return $this->render('JeroenEDCmsEDBundle:Default:index.html.twig', array('title' => 'Home'));
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
