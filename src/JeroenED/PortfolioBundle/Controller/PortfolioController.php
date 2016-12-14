<?php
namespace JeroenED\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PortfolioController extends Controller
{

    protected function getPortfolio($archived = false) {
        $portfolio = array();
        $allPortfolioItems = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:PortfolioItem')->findBy(array('archived' => $archived), array('rank' => 'asc'));
        $i=0;
        foreach ($allPortfolioItems as $item) {
            $portfolio[$i]['title'] = $item->getTitle();
            $portfolio[$i]['rank'] = $item->getRank();
            $portfolio[$i]['pages'] = json_decode($item->getPages(), true);
            $i++;
        }
        return $portfolio;
    }
    
    protected function getMenu() {
        $menu = array();
        $allMenuItems = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:MenuItem')->findBy(array(), array('rank' => 'asc'));
        $i=0;
        foreach ($allMenuItems as $item) {
            $menu[$i]['destination'] = $item->getDestination();
            $menu[$i]['external'] = (strpos($item->getDestination(), 'http://') !== false || strpos($item->getDestination(), 'https://') !== false ) ? true : false;
            $menu[$i]['label'] = $item->getLabel();
            $i++;
        }
        return $menu;
    }
    
    protected function getSettings(Request $request) {
        $settings = array();
        $settings['analytics'] = !($request->cookies->getBoolean('no_analytics'));
        if ($request->query->get('no_analytics')) {
            $response = new Response();
            $response->headers->setCookie(new Cookie('no_analytics', true, time() + (60 * 60 * 24 * 30), '/', null, false, false));
            $response->send();
            $settings['analytics'] = false;
        }
        return $settings;
    }

    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        $portfolio = $this->getPortfolio();
        $menu = $this->getMenu();
        $settings = $this->getSettings($request);
        return $this->render('JeroenEDPortfolioBundle:Portfolio:portfolio.html.twig', array('portfolio' => $portfolio, 'menu' => $menu, 'analytics' => $settings['analytics']));

    }
    
    /**
     * @Route("/archive")
     */
    public function archiveAction(Request $request)
    {
        $portfolio = $this->getPortfolio(true);
        $menu = $this->getMenu();
        $settings = $this->getSettings($request);
        return $this->render('JeroenEDPortfolioBundle:Portfolio:portfolio.html.twig', array('portfolio' => $portfolio, 'menu' => $menu, 'analytics' => $settings['analytics']));

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

    /**
     * @Route("/{slug}")
     */
    public function pageAction($slug, Request $request) {
        $portfolio = $this->getPortfolio();
        $menu = $this->getMenu();
        $settings = $this->getSettings($request);
        return $this->render('JeroenEDPortfolioBundle:Portfolio:page.html.twig', array('slug' => $slug, 'portfolio' => $portfolio, 'menu' => $menu, 'analytics' => $settings['analytics']));
    }
    
    /**
     * @Route("/{slug}/download")
     */
    public function pageDownloadAction($slug) {
        if($slug == 'none') throw new NotFoundHttpException('Page not found');
                
        $page = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:Page')->findOneBy(array("slug" => $slug), array());
        /*var_dump($page);
        exit;*/
        if ($page == null || $page->getDownload() == null) throw new NotFoundHttpException('Page not found');
        return $this->redirect($page->getDownload());
    }
}
