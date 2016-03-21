<?php
namespace JeroenED\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use JeroenED\CmsEDBundle\Model\InitializableControllerInterface;

class PortfolioController extends Controller implements InitializableControllerInterface
{
    private $portfolio;
    private $menu;
    
    public function initialize( Request $request, TokenStorage $security_context) {
        $allPortfolioItems = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:PortfolioItem')->findBy(array(), array('rank' => 'asc'));
        $i=0;
        foreach ($allPortfolioItems as $item) {
            $this->portfolio[$i]['title'] = $item->getTitle();
            $this->portfolio[$i]['rank'] = $item->getRank();
            $this->portfolio[$i]['pages'] = json_decode($item->getPages(), true);
            $i++;
        }
        $allMenuItems = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:MenuItem')->findBy(array(), array('rank' => 'asc'));
        $i=0;
        foreach ($allMenuItems as $item) {
            $this->menu[$i]['destination'] = $item->getDestination();
            $this->menu[$i]['external'] = (strpos($item->getDestination(), 'http://') !== false || strpos($item->getDestination(), 'https://') !== false ) ? true : false;
            $this->menu[$i]['label'] = $item->getLabel();
            $i++;
        }
    }

    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('JeroenEDPortfolioBundle:Portfolio:portfolio.html.twig', array('portfolio' => $this->portfolio, 'menu' => $this->menu));

    }

    /**
     * @Route("/page/{slug}")
     */
    public function pageAction($slug) {
        return $this->render('JeroenEDPortfolioBundle:Portfolio:page.html.twig', array('slug' => $slug, 'portfolio' => $this->portfolio, 'menu' => $this->menu));
    }

    /**
     * @Route("/changelog")
     */
    public function changelogAction() {
        $file = $this->get('kernel')->getRootDir() . '/../changelog.md';
        $handler = $this->container->get('kernel')->locateResource('@JeroenEDPortfolioBundle') . '/markdown/handler.php';
	require $handler;
        return new Response();
    }
}
