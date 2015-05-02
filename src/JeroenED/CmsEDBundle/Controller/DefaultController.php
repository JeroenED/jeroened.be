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
        return $this->render('JeroenEDCmsEDBundle:Default:index.html.twig');
    }
}
