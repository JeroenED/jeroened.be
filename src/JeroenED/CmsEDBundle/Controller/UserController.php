<?php
namespace JeroenED\CmsEDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use JeroenED\CmsEDBundle\Form\Type\UserType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use JeroenED\CmsEDBundle\Initialize\Initializer;
use JeroenED\CmsEDBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

/**
 * Description of UserController
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class UserController extends Controller{
    
    /**
     * @Route("/admin/users", name="users_index")
     */
    public function indexAction(Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $message = $request->query->get('message') ? $request->query->get('message') : '';
        $repository = $this->getDoctrine()->getRepository('JeroenEDCmsEDBundle:User');
        $users = $repository->findAll();
        return $this->render("JeroenEDCmsEDBundle:Users:index.html.twig", array('users' => $users, 'message' => $message,  'title' => 'Users', 'user' => $user, 'menus' => $menus));
    }
    
    /**
     * @Route("/admin/users/edit/{id}", name="users_edit", defaults={ "id" = "-1"})
     */
    public function editAction($id, Request $request) {
		$initializer = new Initializer;
        $cur_user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $db = $this->getDoctrine()->getManager();
        $user = $db->getRepository('JeroenEDCmsEDBundle:User')->find($id);
        $passwordbackup = $user->getPassword();
        $form = $this->createForm(UserType::class, $user, array('action' => $this->generateUrl($request->attributes->get('_route'), array('id' => $user->getId()))));
        $config = $form->get('password')->getConfig()->getOptions();
        $config['required'] = false;
        $form->add('password', RepeatedType::Class, $config);
        $form->add('register', SubmitType::Class, array('label' => 'Confirm'));
        $form->handleRequest($request);
        $form_errors = $this->get('form_errors')->getArray($form, true);
        if($form->isValid()) {
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $newpassword = $form->getData()->getPassword();
            if ($newpassword == '') {
                $user->setPassword($passwordbackup);
            } else {
                $newpassword = $encoder->encodePassword($newpassword, $user->getSalt());
                $user->setPassword($newpassword);
            }
            $db->flush();
            return $this->redirectToRoute('users_index', array('message' => 'User ' . $user->getUsername() . ' has been modified'));           
        } else {
            return $this->render('JeroenEDCmsEDBundle:Users:edit.html.twig', array('form' => $form->createView(),  'title' => 'Users :: Modify ' . $user->getUsername(),'errors' => $form_errors, 'user' => $cur_user, 'menus' => $menus));
        }
    }
    
    /**
     * @Route("/admin/users/details/{id}", name="users_details", defaults={ "id" = "-1"})
     */
    public function detailsAction($id, Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $menus = $initializer->getMenus($request);
        $db = $this->getDoctrine()->getManager();
        $user = $db->getRepository('JeroenEDCmsEDBundle:User')->find($id);
        return $this->render('JeroenEDCmsEDBundle:Users:details.html.twig', array('userdetails' => $user,  'title' => 'Users :: Details of ' . $user->getUsername(), 'user' => $cur_user, 'menus' => $menus));
    }
    
    /**
     * @Route("/admin/users/delete/{id}", name="users_delete", defaults={ "id" = "-1"})
     */
    public function deleteAction($id) {
        $db = $this->getDoctrine()->getManager();
        $user = $db->getRepository('JeroenEDCmsEDBundle:User')->find($id);
        $db->remove($user);
        $db->flush();
        return $this->redirectToRoute('users_index', array('message' => 'User ' . $user->getUsername() . ' has been deleted'));
    }
    
    /**
     * @Route("/admin/users/create", name="users_create")
     */
    public function createAction(Request $request) {
		$initializer = new Initializer;
        $user = $this->getUser()->getUsername();
        $menus = $initializer->getMenus($request);
        $user = new User();
        $db = $this->getDoctrine()->getManager();
        $form = $this->createForm(UserType::class, $user, array('action' => $this->generateUrl($request->attributes->get('_route'))));
        $form->add('register', SubmitType::class, array('label' => 'Confirm'));
        $form->handleRequest($request);
        
        $form_errors = $this->get('form_errors')->getArray($form, true);
        if($form->isValid()) {
            $factory = $this->get('security.encoder_factory');

            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($password);
            
            $db->persist($user);
            $db->flush();
            
            return $this->redirectToRoute('users_index', array('message' => 'User ' . $user->getUsername() . ' has been created'));
            
        } else {
            return $this->render('JeroenEDCmsEDBundle:Users:create.html.twig', array('form' => $form->createView(), 'errors' => $form_errors,  'title' => 'Users :: Create new user', 'user' => $cur_user, 'menus' => $menus));
        }
    }
}
