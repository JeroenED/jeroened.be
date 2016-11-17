<?php
namespace JeroenED\CmsEDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use JeroenED\CmsEDBundle\Initialize\Initializer;
use JeroenED\CmsEDBundle\Entity\User;

class DefaultController extends Controller
{

    /**
     * @Route("/admin"), name="admin_index"
     */
    public function adminAction(Request $request)
    {
        $initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        return $this->render('JeroenEDCmsEDBundle:Default:index.html.twig', array('title' => 'Home', 'user' => $user, 'menus' => $menus));
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
