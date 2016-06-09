<?php
namespace JeroenED\CmsEDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JeroenED\CmsEDBundle\Form\Type\PageType;
use JeroenED\PortfolioBundle\Entity\Page;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use JeroenED\CmsEDBundle\Initialize\Initializer;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use JeroenED\CmsEDBundle\Classes\Functions;

/**
 * Description of PageController
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class PageController extends Controller {

    /**
     * @Route("/admin/pages", name="page_index")
     */
    public function indexAction(Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $message = $request->query->get('message') ? $request->query->get('message') : '';
        $repository = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:Page');
        $pages = $repository->findAll();
        return $this->render("JeroenEDCmsEDBundle:Pages:index.html.twig", array('pages' => $pages, 'message' => $message,  'title' => 'Pages', 'user' => $user, 'menus' => $menus));
    }
    
    /**
     * @Route("/admin/pages/edit/{id}", name="page_edit", defaults={ "id" = "-1"})
     */
    public function editAction($id, Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $db = $this->getDoctrine()->getManager();
        $page = $db->getRepository('JeroenEDPortfolioBundle:Page')->find($id);
        $form = $this->createForm(PageType::Class, $page, array('action' => $this->generateUrl($request->attributes->get('_route'), array('id' => $page->getId()))));
        $form->add('register', SubmitType::Class, array('label' => 'Confirm'));
        $form->handleRequest($request);
        
        $form_errors = $this->get('form_errors')->getArray($form, true);
        if($form->isValid()) {
            $page->setHtml(Functions::encryptEmails($page->getHtml()));
            $db->flush();
            return $this->redirectToRoute('page_index', array('message' => 'Page ' . $page->getTitle() . ' has been modified'));
            
        } else {
            return $this->render('JeroenEDCmsEDBundle:Pages:edit.html.twig', array('form' => $form->createView(), 'errors' => $form_errors,  'title' => 'Pages :: Modify ' . $page->getTitle(), 'user' => $user, 'menus' => $menus));
        }
    }
    
    /**
     * @Route("/admin/pages/details/{id}", name="page_details", defaults={ "id" = "-1"})
     */
    public function detailsAction($id, Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $db = $this->getDoctrine()->getManager();
        $page = $db->getRepository('JeroenEDPortfolioBundle:Page')->find($id);
        return $this->render('JeroenEDCmsEDBundle:Pages:details.html.twig', array('page' => $page,  'title' => 'Pages :: Details of ' . $page->getTitle(), 'user' => $user, 'menus' => $menus));
    }
    
    /**
     * @Route("/admin/pages/delete/{id}", name="page_delete", defaults={ "id" = "-1"})
     */
    public function deleteAction($id) {
        $db = $this->getDoctrine()->getManager();
        $page = $db->getRepository('JeroenEDPortfolioBundle:Page')->find($id);
        $db->remove($page);
        $db->flush();
        return $this->redirectToRoute('page_index', array('message' => 'Page ' . $page->getTitle() . ' has been deleted'));
    }
    
    /**
     * @Route("/admin/pages/create", name="page_create")
     */
    public function createAction(Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $page = new Page();
        $db = $this->getDoctrine()->getManager();
        $form = $this->createForm(PageType::Class, $page, array('action' => $this->generateUrl($request->attributes->get('_route'))));
        $form->add('register', SubmitType::Class, array('label' => 'Confirm'));
        $form->handleRequest($request);
        
        $form_errors = $this->get('form_errors')->getArray($form, true);
        if($form->isValid()) {
            $page->setHtml(Functions::encryptEmails($page->getHtml()));
            
            $db->persist($page);
            $db->flush();
            
            return $this->redirectToRoute('page_index', array('message' => 'Page ' . $page->getTitle() . ' has been created'));
            
        } else {
            return $this->render('JeroenEDCmsEDBundle:Pages:create.html.twig', array('form' => $form->createView(), 'errors' => $form_errors,  'title' => 'Pages :: Create new page', 'user' => $user, 'menus' => $menus));
        }
    }
}
