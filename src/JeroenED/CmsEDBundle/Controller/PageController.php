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
use JeroenED\CmsEDBundle\Form\Type\PageType;
use JeroenED\PortfolioBundle\Entity\Page;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use JeroenED\CmsEDBundle\Model\InitializableControllerInterface;
use JeroenED\CmsEDBundle\Initialize\Initializer;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use JeroenED\CmsEDBundle\Classes\Functions;

/**
 * Description of PageController
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class PageController extends Controller implements InitializableControllerInterface  {
    
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
     * @Route("/admin/pages", name="page_index")
     */
    public function indexAction(Request $request) {
        $message = $request->query->get('message') ? $request->query->get('message') : '';
        $repository = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:Page');
        $pages = $repository->findAll();
        return $this->render("JeroenEDCmsEDBundle:Pages:index.html.twig", array('pages' => $pages, 'message' => $message,  'title' => 'Pages', 'init' => $this->init));
    }
    
    /**
     * @Route("/admin/pages/edit/{id}", name="page_edit", defaults={ "id" = "-1"})
     */
    public function editAction($id, Request $request) {
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
            return $this->render('JeroenEDCmsEDBundle:Pages:edit.html.twig', array('form' => $form->createView(), 'errors' => $form_errors,  'title' => 'Pages :: Modify ' . $page->getTitle(), 'init' => $this->init));
        }
    }
    
    /**
     * @Route("/admin/pages/details/{id}", name="page_details", defaults={ "id" = "-1"})
     */
    public function detailsAction($id) {
        $db = $this->getDoctrine()->getManager();
        $page = $db->getRepository('JeroenEDPortfolioBundle:Page')->find($id);
        return $this->render('JeroenEDCmsEDBundle:Pages:details.html.twig', array('page' => $page,  'title' => 'Pages :: Details of ' . $page->getTitle(), 'init' => $this->init));
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
            return $this->render('JeroenEDCmsEDBundle:Pages:create.html.twig', array('form' => $form->createView(), 'errors' => $form_errors,  'title' => 'Pages :: Create new page', 'init' => $this->init));
        }
    }
}
