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
use JeroenED\CmsEDBundle\Form\Type\MenuType;
use JeroenED\PortfolioBundle\Entity\MenuItem;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use JeroenED\CmsEDBundle\Model\InitializableControllerInterface;
use JeroenED\CmsEDBundle\Initialize\Initializer;
use JeroenED\CmsEDBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Description of MenuController
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class MenuController extends Controller implements InitializableControllerInterface  {
    
    private $init;
    
    public function initialize( Request $request, TokenStorage $security_context) {
        $kernel = $this->get('kernel');
        $dev = ($kernel->getEnvironment() == 'dev') ? true : false;
        $this->init['user'] = $this->getUser()->getUsername();
        $initializer = new Initializer();
        $parts = $initializer->getWebsiteParts();
        $route = $this->generateUrl($request->attributes->get('_route'));
        if ($dev) $route = explode('/app_dev.php', $route)[1];
        foreach ($parts as $key1 => $part1) {
            foreach($part1['parts'] as $key2 => $part2) {
                if($route == $part2['link']) {
                    $parts[$key1]['parts'][$key2]['active'] = true;
                }
            }
            if (stripos($route, $part1['link']) !== false) $this->init['uppernav'] = $parts[$key1]['parts'];
        }
        
        
        $this->init['leftnav'] = $parts;
    }
    /**
     * @Route("/admin/menu", name="menu_index")
     */
    public function indexAction(Request $request) {
        $message = $request->query->get('message') ? $request->query->get('message') : '';
        $repository = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:MenuItem');
        $menus = $repository->findAll();
        return $this->render("JeroenEDCmsEDBundle:Menu:index.html.twig", array('menus' => $menus, 'message' => $message, 'title' => 'Menus', 'init' => $this->init));
    }
    
    /**
     * @Route("/admin/menu/edit/{id}", name="menu_edit", defaults={ "id" = "-1"})
     */
    public function editAction($id, Request $request) {
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
            return $this->render('JeroenEDCmsEDBundle:Menu:edit.html.twig', array('form' => $form->createView(), 'errors' => $form_errors,  'title' => 'Menus :: Modify ' . $menu->getLabel(), 'init' => $this->init));
        }
    }
    
    /**
     * @Route("/admin/menu/details/{id}", name="menu_details", defaults={ "id" = "-1"})
     */
    public function detailsAction($id) {
        $db = $this->getDoctrine()->getManager();
        $menu = $db->getRepository('JeroenEDPortfolioBundle:MenuItem')->find($id);
        return $this->render('JeroenEDCmsEDBundle:Menu:details.html.twig', array('menu' => $menu,  'title' => 'Menus :: Details of ' . $menu->getLabel(), 'init' => $this->init));
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
        $menu = new MenuItem();
        $db = $this->getDoctrine()->getManager();
        $form = $this->createForm(MenuType::Class, $menu, array('action' => $this->generateUrl($request->attributes->get('_route'))));
        $form->add('register', SubmitType::Class, array('label' => 'Confirm'));
        $form->handleRequest($request);
        
        $form_errors = $this->get('form_errors')->getArray($form, true);
        if($form->isValid()) {
            $db->persist($menu);
            $db->flush();
            
            return $this->redirectToRoute('menu_index', array('message' => 'Menuitem ' . $menu->getLabel() . ' has been created'));
            
        } else {
            return $this->render('JeroenEDCmsEDBundle:Menu:create.html.twig', array('form' => $form->createView(), 'errors' => $form_errors,  'title' => 'Menus :: Create new menu', 'init' => $this->init));
        }
    }
}
