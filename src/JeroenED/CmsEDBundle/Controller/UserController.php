<?php

/*
 * The MIT License
 *
 * Copyright 2015 Jeroen De Meerleer <me@jeroened.be>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace JeroenED\CmsEDBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use JeroenED\CmsEDBundle\Form\Type\UserType;
use Symfony\Component\Security\Core\SecurityContextInterface;
use JeroenED\CmsEDBundle\Model\InitializableControllerInterface;
use JeroenED\CmsEDBundle\Entity\User;

/**
 * Description of UserController
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class UserController extends Controller implements InitializableControllerInterface {
    
    private $init;
    
    public function initialize( Request $request, SecurityContextInterface $security_context) {
        $init['user'] = $this->getUser()->getUsername();
    }
    
    /**
     * @Route("/admin/users", name="users_index")
     */
    public function indexAction() {
        $request = $this->getRequest();
        $message = $request->query->get('message') ? $request->query->get('message') : '';
        $repository = $this->getDoctrine()->getRepository('JeroenEDCmsEDBundle:User');
        $users = $repository->findAll();
        return $this->render("JeroenEDCmsEDBundle:Users:index.html.twig", array('users' => $users, 'message' => $message,  'title' => 'Users'));
    }
    
    /**
     * @Route("/admin/users/edit/{id}", name="users_edit")
     */
    public function editAction($id, Request $request) {
        $db = $this->getDoctrine()->getManager();
        $user = $db->getRepository('JeroenEDCmsEDBundle:User')->find($id);
        $passwordbackup = $user->getPassword();
        $form = $this->createForm(new UserType(), $user, array('action' => $this->generateUrl($request->attributes->get('_route'), array('id' => $user->getId()))));
        $config = $form->get('password')->getConfig()->getOptions();
        $config['required'] = false;
        $form->add('password', 'repeated', $config);
        $form->add('current', 'password', array('label' => 'Current password', 'mapped' => false));
        $form->add('register', 'submit', array('label' => 'Confirm'));
        $form->handleRequest($request);
        
        $form_errors = $this->get('form_errors')->getArray($form, true);
        if($form->isValid()) {
            $factory = $this->get('security.encoder_factory');

            $encoder = $factory->getEncoder($user);
            $password = $form->all()['current']->getData();
            if ($encoder->isPasswordValid($passwordbackup, $password, $user->getSalt())) {
                
                $newpassword = $form->getData()->getPassword();
                if ($newpassword == '') {
                    $user->setPassword($passwordbackup);
                } else {
                    $newpassword = $encoder->encodePassword($newpassword, $user->getSalt());
                    $user->setPassword($newpassword);
                }
            
                $db->flush();
                
                return $this->redirectToRoute('users_index', array('message' => 'User ' . $user->getUsername() . ' has been modified'));
            }
            $form_errors[] = 'Invalid current password';
            return $this->redirectToRoute($request->attributes->get('_route'), array( 'errors' => $form_errors));
            
        } else {
            return $this->render('JeroenEDCmsEDBundle:Users:edit.html.twig', array('form' => $form->createView(),  'title' => 'Users :: Modify ' . $user->getUsername()));
        }
    }
    
    /**
     * @Route("/admin/users/details/{id}", name="users_details")
     */
    public function detailsAction($id) {
        $db = $this->getDoctrine()->getManager();
        $user = $db->getRepository('JeroenEDCmsEDBundle:User')->find($id);
        return $this->render('JeroenEDCmsEDBundle:Users:details.html.twig', array('user' => $user,  'title' => 'Users :: Details of ' . $user->getUsername()));
    }
    
    /**
     * @Route("/admin/users/delete/{id}", name="users_delete")
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
        $user = new User();
        $db = $this->getDoctrine()->getManager();
        $form = $this->createForm(new UserType(), $user, array('action' => $this->generateUrl($request->attributes->get('_route'))));
        $form->add('register', 'submit', array('label' => 'Confirm'));
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
            return $this->render('JeroenEDCmsEDBundle:Users:create.html.twig', array('form' => $form->createView(), 'errors' => $form_errors,  'title' => 'Users :: Create new user'));
        }
    }
}
