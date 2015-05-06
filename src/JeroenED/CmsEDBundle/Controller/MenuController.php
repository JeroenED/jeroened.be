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

/**
 * Description of UserController
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class MenuController extends Controller {
    
    /**
     * @Route("/admin/menu", name="menu_index")
     */
    public function indexAction() {
        $request = $this->getRequest();
        $message = $request->query->get('message') ? $request->query->get('message') : '';
        $repository = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:MenuItem');
        $menus = $repository->findAll();
        return $this->render("JeroenEDCmsEDBundle:Menu:index.html.twig", array('menus' => $menus, 'message' => $message));
    }
    
    /**
     * @Route("/admin/menu/edit/{id}", name="menu_edit")
     */
    public function editAction($id, Request $request) {
        $db = $this->getDoctrine()->getManager();
        $menu = $db->getRepository('JeroenEDPortfolioBundle:MenuItem')->find($id);
        $form = $this->createForm(new MenuType(), $menu, array('action' => $this->generateUrl($request->attributes->get('_route'), array('id' => $menu->getId()))));
        $form->add('register', 'submit', array('label' => 'Confirm'));
        $form->handleRequest($request);
        
        $form_errors = $this->get('form_errors')->getArray($form, true);
        if($form->isValid()) {
            $db->flush();
            return $this->redirectToRoute('users_index', array('message' => 'Menuitem ' . $user->getLabel() . ' has been modified'));
            
        } else {
            return $this->render('JeroenEDCmsEDBundle:Menu:edit.html.twig', array('form' => $form->createView(), 'errors' => $form_errors));
        }
    }
    
    /**
     * @Route("/admin/menu/details/{id}", name="menu_details")
     */
    public function detailsAction($id) {
        $db = $this->getDoctrine()->getManager();
        $menu = $db->getRepository('JeroenEDPortfolioBundle:MenuItem')->find($id);
        return $this->render('JeroenEDCmsEDBundle:Menu:details.html.twig', array('menu' => $menu));
    }
    
    /**
     * @Route("/admin/menu/delete/{id}", name="menu_delete")
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
        $form = $this->createForm(new MenuType(), $menu, array('action' => $this->generateUrl($request->attributes->get('_route'))));
        $form->add('register', 'submit', array('label' => 'Confirm'));
        $form->handleRequest($request);
        
        $form_errors = $this->get('form_errors')->getArray($form, true);
        if($form->isValid()) {
            $db->persist($menu);
            $db->flush();
            
            return $this->redirectToRoute('menu_index', array('message' => 'Menuitem ' . $menu->getLabel() . ' has been created'));
            
        } else {
            return $this->render('JeroenEDCmsEDBundle:Menu:create.html.twig', array('form' => $form->createView(), 'errors' => $form_errors));
        }
    }
}
