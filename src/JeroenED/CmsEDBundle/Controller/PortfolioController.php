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
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use JeroenED\CmsEDBundle\Model\InitializableControllerInterface;
use JeroenED\CmsEDBundle\Initialize\Initializer;
use JeroenED\CmsEDBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

/**
 * Description of PortfolioController
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class PortfolioController extends Controller implements InitializableControllerInterface  {

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
     * @Route("/admin/portfolio", name="portfolio_index")
     */
    public function indexAction(Request $request) {
        $message = $request->query->get('message') ? $request->query->get('message') : '';
        $repository = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:PortfolioItem');
        $portfolio = $repository->findBy(array(), array('rank' => 'asc'));
        return $this->render("JeroenEDCmsEDBundle:Portfolio:index.html.twig", array('portfolio' => $portfolio, 'message' => $message, 'title' => 'Portfolio', 'init' => $this->init));
    }
    
    /**
     * @Route("/admin/portfolio/edit/{id}", name="portfolio_edit", defaults={ "id" = "-1"})
     */
    public function editAction($id, Request $request) {
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
            return $this->redirectToRoute('portfolio_index', array('message' => 'Portfolioitem ' . $item->getTitle() . ' has been modified'));
            
        } else {
            return $this->render('JeroenEDCmsEDBundle:Portfolio:edit.html.twig', array('form' => $form->createView(), 'pageform' => $pageform->createView(), 'pages' => $pages, 'errors' => $form_errors,  'title' => 'Portfolio :: Modify ' . $item->getTitle(), 'init' => $this->init));
        }
    }
    
    /**
     * @Route("/admin/portfolio/details/{id}", name="portfolio_details", defaults={ "id" = "-1"})
     */
    public function detailsAction($id) {
        $db = $this->getDoctrine()->getManager();
        $item = $db->getRepository('JeroenEDPortfolioBundle:PortfolioItem')->find($id);
        $pages = json_decode($item->getPages());
        return $this->render('JeroenEDCmsEDBundle:Portfolio:details.html.twig', array('portfolio' => $item, 'pages' => $pages, 'title' => 'Portfolio :: Details of ' . $item->getTitle(), 'init' => $this->init));
    }
    
    /**
     * @Route("/admin/portfolio/delete/{id}", name="portfolio_delete", defaults={ "id" = "-1"})
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
            $db->persist($item);
            $db->flush();
            
            return $this->redirectToRoute('portfolio_index', array('message' => 'Page ' . $item->getTitle() . ' has been created'));
            
        } else {
            return $this->render('JeroenEDCmsEDBundle:Portfolio:create.html.twig', array('form' => $form->createView(), 'pageform' => $pageform->createView(), 'errors' => $form_errors,   'title' => 'Portfolio :: Create new item', 'init' => $this->init));
        }
    }
    
    
    /**
     * @Route("/admin/portfolio/rankupdate", name="portfolio_ranks")
     */
    public function rankAction(Request $request) {
        $ranks = json_decode($request->request->get('ranks'), true);
        $db = $this->getDoctrine()->getManager();
        foreach($ranks as $key=>$value) {
            $item = $db->getRepository('JeroenEDPortfolioBundle:PortfolioItem')->find($key);
            $item->setRank($value);
        }
        $db->flush();
        return $this->redirectToRoute('portfolio_index', array('message' => 'The order has been updated'));
    }
}
