<?php
namespace JeroenED\CmsEDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JeroenED\CmsEDBundle\Form\Type\MenuType;
use JeroenED\PortfolioBundle\Entity\MenuItem;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use JeroenED\CmsEDBundle\Initialize\Initializer;
use JeroenED\CmsEDBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Description of MenuController
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class MenuController extends Controller  {
    
    /**
     * @Route("/admin/menu", name="menu_index")
     */
    public function indexAction(Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $message = $request->query->get('message') ? $request->query->get('message') : '';
        $repository = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:MenuItem');
        $menuitems = $repository->findBy(array(), array('rank' => 'asc'));
        return $this->render("JeroenEDCmsEDBundle:Menu:index.html.twig", array('menuitems' => $menuitems, 'message' => $message, 'title' => 'Menus', 'user' => $user, 'menus' => $menus));
    }
    
    /**
     * @Route("/admin/menu/edit/{id}", name="menu_edit", defaults={ "id" = "-1"})
     */
    public function editAction($id, Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $db = $this->getDoctrine()->getManager();
        $menu = $db->getRepository('JeroenEDPortfolioBundle:MenuItem')->find($id);
        $form = $this->createForm(MenuType::Class, $menu, array('action' => $this->generateUrl($request->attributes->get('_route'), array('id' => $menu->getId()))));
        $form->add('register', SubmitType::Class, array('label' => 'Confirm'));
        $form->handleRequest($request);
        
        $form_errors = $this->get('form_errors')->getArray($form, true);
        if($form->isValid()) {
            $db->flush();
            return $this->redirectToRoute('menu_index', array('message' => 'Menuitem ' . $menu->getLabel() . ' has been modified'));
            
        } else {
            return $this->render('JeroenEDCmsEDBundle:Menu:edit.html.twig', array('form' => $form->createView(), 'errors' => $form_errors,  'title' => 'Menus :: Modify ' . $menu->getLabel(), 'user' => $user, 'menus' => $menus));
        }
    }
    
    /**
     * @Route("/admin/menu/details/{id}", name="menu_details", defaults={ "id" = "-1"})
     */
    public function detailsAction($id, Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $db = $this->getDoctrine()->getManager();
        $menu = $db->getRepository('JeroenEDPortfolioBundle:MenuItem')->find($id);
        return $this->render('JeroenEDCmsEDBundle:Menu:details.html.twig', array('menu' => $menu,  'title' => 'Menus :: Details of ' . $menu->getLabel(), 'user' => $user, 'menus' => $menus));
    }
    
    /**
     * @Route("/admin/menu/delete/{id}", name="menu_delete", defaults={ "id" = "-1"})
     */
    public function deleteAction($id) {
        $db = $this->getDoctrine()->getManager();
        $menu = $db->getRepository('JeroenEDPortfolioBundle:MenuItem')->find($id);
        $db->remove($menu);
        $db->flush();
        return $this->redirectToRoute('menu_index', array('message' => 'Menuitem ' . $menu->getLabel() . ' has been deleted'));
    }
    
    /**
     * @Route("/admin/menu/create", name="menu_create")
     */
    public function createAction(Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $menu = new MenuItem();
        $db = $this->getDoctrine()->getManager();
        $form = $this->createForm(MenuType::Class, $menu, array('action' => $this->generateUrl($request->attributes->get('_route'))));
        $form->add('register', SubmitType::Class, array('label' => 'Confirm'));
        $form->handleRequest($request);
        
        $form_errors = $this->get('form_errors')->getArray($form, true);
        if($form->isValid()) {
            $repository = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:PortfolioItem');
            $rank = count($repository->findAll())+1;
            $menu->setRank($rank);
            $db->persist($menu);
            $db->flush();
            
            return $this->redirectToRoute('menu_index', array('message' => 'Menuitem ' . $menu->getLabel() . ' has been created'));
            
        } else {
            return $this->render('JeroenEDCmsEDBundle:Menu:create.html.twig', array('form' => $form->createView(), 'errors' => $form_errors,  'title' => 'Menus :: Create new menu', 'user' => $user, 'menus' => $menus));
        }
    }

    /**
     * @Route("/admin/menu/rankupdate", name="menu_ranks", defaults={ "id" = "-1"})
     */
    public function rankAction(Request $request) {
        $ranks = json_decode($request->request->get('ranks'), true);
        $db = $this->getDoctrine()->getManager();
        foreach($ranks as $key=>$value) {
            $item = $db->getRepository('JeroenEDPortfolioBundle:MenuItem')->find($key);
            $item->setRank($value);
        }
        $db->flush();
        return $this->redirectToRoute('menu_index', array('message' => 'The order has been updated'));
    }
}
