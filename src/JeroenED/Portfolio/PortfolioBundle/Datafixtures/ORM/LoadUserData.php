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

namespace JeroenED\Portfolio\PortfolioBundle\Datafixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use JeroenED\Portfolio\PortfolioBundle\Entity\PortfolioItem;

/**
 * This class initiates the data in the database
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class LoadUserData implements FixtureInterface{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        
        // Homepage
        $home = new PortfolioItem();
        $home->setTitle("Homepage");
        
        $i = 0;
        $homePages[$i]['ShowTitle'] = false;
        $homePages[$i]['Html'] = '<h1 class="title">Jeroen De Meerleer</h1><h2 class="author">Developer-Operator</h2><p class="small" style="margin-top: 50px;">Gebruik de pijltjes om mijn portfolio weer te geven.</p>';
        
        $home->setPages(serialize($homePages));
                
        $home->setRank(1);
        
        $manager->persist($home);
        
        
        // Instant Bugfix
        $ibf = new PortfolioItem();
        $ibf->setTitle("Instant Bugfix");
        
        $i = 0;
        $ibfPages[$i]['ShowTitle'] = false;
        $ibfPages[$i]['Slug'] = "instantbugfix";
        $ibfPages[$i]['Html'] = '<p>&nbsp;</p>';
        $ibfPages[$i]['Background'] = '/content/images/projects/instantbugfix/home.png';
        
        $i++;
        $ibfPages[$i]['ShowTitle'] = true;
        $ibfPages[$i]['Slug'] = "instantbugfix/doel";
        $ibfPages[$i]['Html'] = '<h2>Wat was het doel?</h2><p>Maak een project om door te sturen naar potenti&euml;le werkgevers.</p>';
        
        $i++;
        $ibfPages[$i]['ShowTitle'] = true;
        $ibfPages[$i]['Slug'] = "instantbugfix/geleerd";
        $ibfPages[$i]['Html'] = '<h2>Wat heb ik geleerd?</h2><ul><li>Responsive design</li><li>Spoon library</li><li>Git</li></ul>';
       
        $i++;
        $ibfPages[$i]['ShowTitle'] = true;
        $ibfPages[$i]['Slug'] = "instantbugfix/live";
        $ibfPages[$i]['Html'] = '<h2>Bekijk het zelf!</h2><p><a href="http://instantbugfix.jeroened.be/" target="_blank">instantbugfix.jeroened.be</a></p><p><a href="http://git.jeroened.be/JeroenED/instant-bugfix" target="_blank">Git-project</a></p>';
       
        $ibf->setPages(serialize($ibfPages));
        
        $ibf->setRank(2);
        
        $manager->persist($ibf);
        
        // Tuinhier
        $th = new PortfolioItem();
        $th->setTitle("Tuinhier Waregem");
        
        $i = 0;
        $thPages[$i]['ShowTitle'] = false;
        $thPages[$i]['Slug'] = "tuinhier";
        $thPages[$i]['Html'] = '<p>&nbsp;</p>';
        $thPages[$i]['Background'] = '/content/images/projects/tuinhier/home.png';
        
        $i++;
        $thPages[$i]['ShowTitle'] = true;
        $thPages[$i]['Slug'] = "tuinhier/doel";
        $thPages[$i]['Html'] = '<h2>Wat was het doel?</h2><p>Maak een nieuwe website voor onze vereniging, waarbij een lid zonder veel kennis de website kan bewerken</p>';
        
        $i++;
        $thPages[$i]['ShowTitle'] = true;
        $thPages[$i]['Slug'] = "tuinhier/geleerd";
        $thPages[$i]['Html'] = '<h2>Wat heb ik geleerd?</h2><ul><li>Zelf een CMS maken</li><li>CKeditor</li></ul>';
       
        $i++;
        $thPages[$i]['ShowTitle'] = true;
        $thPages[$i]['Slug'] = "tuinhier/live";
        $thPages[$i]['Html'] = '<h2>Bekijk het zelf!</h2><p><a href="http://www.tuinhierwaregem.be/" target="_blank">tuinhierwaregem.be</a></p>';
       
        $th->setPages(serialize($thPages));
           
        
        $th->setRank(3);
        $manager->persist($th);
        
        $manager->flush();
    }
}
