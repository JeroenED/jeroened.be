<?php
namespace JeroenED\CmsEDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JeroenED\CmsEDBundle\Form\Type\PortfolioType;
use JeroenED\CmsEDBundle\Form\Type\PortfolioPageType;
use JeroenED\PortfolioBundle\Entity\PortfolioItem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use JeroenED\CmsEDBundle\Initialize\Initializer;
use JeroenED\CmsEDBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

/**
 * Description of PortfolioController
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class PortfolioController extends Controller  {
	
    /**
     * @Route("/admin/portfolio", name="portfolio_index")
     */
    public function indexAction(Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $message = $request->query->get('message') ? $request->query->get('message') : '';
        $repository = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:PortfolioItem');
        $portfolio = $repository->findBy(array('archived' => false), array('rank' => 'asc'));
        return $this->render("JeroenEDCmsEDBundle:Portfolio:index.html.twig", array('portfolio' => $portfolio, 'message' => $message, 'title' => 'Portfolio', 'user' => $user, 'menus' => $menus));
    }
	
	/**
     * @Route("/admin/portfolio/archive", name="portfolio_archive")
     */
    public function archiveAction(Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $message = $request->query->get('message') ? $request->query->get('message') : '';
        $repository = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:PortfolioItem');
        $portfolio = $repository->findBy(array('archived' => true), array('rank' => 'asc'));
        return $this->render("JeroenEDCmsEDBundle:Portfolio:archive.html.twig", array('portfolio' => $portfolio, 'message' => $message, 'title' => 'Portfolio', 'user' => $user, 'menus' => $menus));
    }
    
    /**
     * @Route("/admin/portfolio/edit/{id}", name="portfolio_edit", defaults={ "id" = "-1"})
     */
    public function editAction($id, Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $db = $this->getDoctrine()->getManager();
        $item = $db->getRepository('JeroenEDPortfolioBundle:PortfolioItem')->find($id);
        $pages = json_decode($item->getPages(), true);
        $form = $this->createForm(PortfolioType::class, $item, array('action' => $this->generateUrl($request->attributes->get('_route'), array('id' => $item->getId()))));
        $form->add('register', SubmitType::class, array('label' => 'Confirm'));
        $pageform = $this->createForm(PortfolioPageType::class, null, array('action' => "#"));
        $pageform->add('register', ButtonType::class, array('label' => 'Add page'));
        $form->handleRequest($request);
        
        $form_errors = $this->get('form_errors')->getArray($form, true);
        if($form->isValid()) {
            $db->flush();
			$returnurl = $item->getArchived() ? "portfolio_archive" : "portfolio_index";
            return $this->redirectToRoute($returnurl, array('message' => 'Portfolioitem ' . $item->getTitle() . ' has been modified'));
            
        } else {
            return $this->render('JeroenEDCmsEDBundle:Portfolio:edit.html.twig', array('form' => $form->createView(), 'pageform' => $pageform->createView(), 'pages' => $pages, 'errors' => $form_errors,  'title' => 'Portfolio :: Modify ' . $item->getTitle(), 'user' => $user, 'menus' => $menus));
        }
    }
    
    /**
     * @Route("/admin/portfolio/details/{id}", name="portfolio_details", defaults={ "id" = "-1"})
     */
    public function detailsAction($id, Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $db = $this->getDoctrine()->getManager();
        $item = $db->getRepository('JeroenEDPortfolioBundle:PortfolioItem')->find($id);
        $pages = json_decode($item->getPages());
        return $this->render('JeroenEDCmsEDBundle:Portfolio:details.html.twig', array('portfolio' => $item, 'pages' => $pages, 'title' => 'Portfolio :: Details of ' . $item->getTitle(), 'user' => $user, 'menus' => $menus));
    }
    
    /**
     * @Route("/admin/portfolio/delete/{id}", name="portfolio_delete", defaults={ "id" = "-1"})
     */
    public function deleteAction(Request $request, $id) {
		$returnurl = $request->query->get('returnurl') ? $request->query->get('returnurl') : 'portfolio_index';
        $db = $this->getDoctrine()->getManager();
        $item = $db->getRepository('JeroenEDPortfolioBundle:PortfolioItem')->find($id);
        $db->remove($item);
        $db->flush();
        return $this->redirectToRoute($returnurl, array('message' => 'Portfolioitem ' . $item->getTitle() . ' has been deleted'));
    }
    
    /**
     * @Route("/admin/portfolio/create", name="portfolio_create")
     */
    public function createAction(Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $item = new PortfolioItem();
        $db = $this->getDoctrine()->getManager();
        $form = $this->createForm(PortfolioType::class, $item, array('action' => $this->generateUrl($request->attributes->get('_route'))));
         $form->add('register', SubmitType::class, array('label' => 'Confirm'));
        $pageform = $this->createForm(PortfolioPageType::class, null, array('action' => "#"));
        $pageform->add('register', ButtonType::class, array('label' => 'Add page'));
        $form->handleRequest($request);
        
        $form_errors = $this->get('form_errors')->getArray($form, true);
        if($form->isValid()) {
       	    $repository = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:PortfolioItem');
            $rank = count($repository->findAll())+1;
            $item->setRank($rank);
			$returnurl = $item->getArchived() ? "portfolio_archive" : "portfolio_index";
            $db->persist($item);
            $db->flush();
            
            return $this->redirectToRoute($returnurl, array('message' => 'Portfolioitem ' . $item->getTitle() . ' has been created'));
            
        } else {
            return $this->render('JeroenEDCmsEDBundle:Portfolio:create.html.twig', array('form' => $form->createView(), 'pageform' => $pageform->createView(), 'errors' => $form_errors,   'title' => 'Portfolio :: Create new item', 'user' => $user, 'menus' => $menus));
        }
    }
    
    
    /**
     * @Route("/admin/portfolio/rankupdate", name="portfolio_ranks", defaults={ "id" = "-1"})
     */
    public function rankAction(Request $request) {
        $ranks = json_decode($request->request->get('ranks'), true);
        $returnurl = $request->request->get('returnurl') ? $request->request->get('returnurl') : 'portfolio_index';
        $db = $this->getDoctrine()->getManager();
        foreach($ranks as $key=>$value) {
            $item = $db->getRepository('JeroenEDPortfolioBundle:PortfolioItem')->find($key);
            $item->setRank($value);
        }
        $db->flush();
        return $this->redirectToRoute($returnurl, array('message' => 'The order has been updated'));
    }
}
