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
use JeroenED\CmsEDBundle\Form\Type\PortfolioType;
use JeroenED\CmsEDBundle\Form\Type\PortfolioPageType;
use JeroenED\PortfolioBundle\Entity\PortfolioItem;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of PortfolioController
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class PortfolioController extends Controller {
    
    /**
     * @Route("/admin/portfolio", name="portfolio_index")
     */
    public function indexAction() {
        $request = $this->getRequest();
        $message = $request->query->get('message') ? $request->query->get('message') : '';
        $repository = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:PortfolioItem');
        $portfolio = $repository->findAll();
        return $this->render("JeroenEDCmsEDBundle:Portfolio:index.html.twig", array('portfolio' => $portfolio, 'message' => $message, 'title' => 'Portfolio'));
    }
    
    /**
     * @Route("/admin/portfolio/edit/{id}", name="portfolio_edit")
     */
    public function editAction($id, Request $request) {
        $db = $this->getDoctrine()->getManager();
        $item = $db->getRepository('JeroenEDPortfolioBundle:PortfolioItem')->find($id);
        $pages = json_decode($item->getPages(), true);
        $form = $this->createForm(new PortfolioType(), $item, array('action' => $this->generateUrl($request->attributes->get('_route'), array('id' => $item->getId()))));
        $form->add('register', 'submit', array('label' => 'Confirm'));
        $pageform = $this->createForm(new PortfolioPageType(), null, array('action' => "#"));
        $pageform->add('register', 'button', array('label' => 'Add page'));
        $form->handleRequest($request);
        
        $form_errors = $this->get('form_errors')->getArray($form, true);
        if($form->isValid()) {
            $db->flush();
            return $this->redirectToRoute('portfolio_index', array('message' => 'Portfolioitem ' . $item->getTitle() . ' has been modified'));
            
        } else {
            return $this->render('JeroenEDCmsEDBundle:Portfolio:edit.html.twig', array('form' => $form->createView(), 'pageform' => $pageform->createView(), 'pages' => $pages, 'errors' => $form_errors,  'title' => 'Portfolio :: Modify ' . $item->getTitle()));
        }
    }
    
    /**
     * @Route("/admin/portfolio/details/{id}", name="portfolio_details")
     */
    public function detailsAction($id) {
        $db = $this->getDoctrine()->getManager();
        $item = $db->getRepository('JeroenEDPortfolioBundle:PortfolioItem')->find($id);
        $pages = json_decode($item->getPages());
        return $this->render('JeroenEDCmsEDBundle:Portfolio:details.html.twig', array('portfolio' => $item, 'pages' => $pages, 'title' => 'Portfolio :: Details of ' . $item->getTitle()));
    }
    
    /**
     * @Route("/admin/portfolio/delete/{id}", name="portfolio_delete")
     */
    public function deleteAction($id) {
        $db = $this->getDoctrine()->getManager();
        $item = $db->getRepository('JeroenEDPortfolioBundle:PortfolioItem')->find($id);
        $db->remove($item);
        $db->flush();
        return $this->redirectToRoute('portfolio_index', array('message' => 'Page ' . $item->getTitle() . ' has been deleted'));
    }
    
    /**
     * @Route("/admin/portfolio/create", name="portfolio_create")
     */
    public function createAction(Request $request) {
        $item = new PortfolioItem();
        $db = $this->getDoctrine()->getManager();
        $form = $this->createForm(new PortfolioType(), $item, array('action' => $this->generateUrl($request->attributes->get('_route'))));
        $form->add('register', 'submit', array('label' => 'Confirm'));
        $pageform = $this->createForm(new PortfolioPageType(), null, array('action' => "#"));
        $pageform->add('register', 'button', array('label' => 'Add page'));
        $form->handleRequest($request);
        
        $form_errors = $this->get('form_errors')->getArray($form, true);
        if($form->isValid()) {
            $db->persist($item);
            $db->flush();
            
            return $this->redirectToRoute('portfolio_index', array('message' => 'Page ' . $item->getTitle() . ' has been created'));
            
        } else {
            return $this->render('JeroenEDCmsEDBundle:Portfolio:create.html.twig', array('form' => $form->createView(), 'pageform' => $pageform->createView(), 'errors' => $form_errors,   'title' => 'Portfolio :: Create new item'));
        }
    }
    
    
}