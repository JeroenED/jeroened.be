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

namespace JeroenED\PortfolioBundle\Datafixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use JeroenED\PortfolioBundle\Entity\PortfolioItem;
use JeroenED\PortfolioBundle\Entity\Page;
use JeroenED\PortfolioBundle\Entity\MenuItem;

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
        
        $it=0; // Homepage
        $dbItems[$it] = new PortfolioItem();
        $dbItems[$it]->setTitle("Homepage");
        
        $i = 0;
        $portPages[$i]['ShowTitle'] = false;
        $portPages[$i]['Html'] = '<h1 class="title">Jeroen De Meerleer</h1><h2 class="author">Developer-Operator</h2><p class="small" style="margin-top: 50px;">Gebruik de pijltjes om mijn portfolio weer te geven.</p>';
        
        $dbItems[$it]->setPages(serialize($portPages));
                
        $dbItems[$it]->setRank(1);
                
        
        $it++; // Instant Bugfix
        $dbItems[$it] = new PortfolioItem();
        $dbItems[$it]->setTitle("Instant Bugfix");
        
        $portPages = null; $i = 0;
        $portPages[$i]['ShowTitle'] = false;
        $portPages[$i]['Slug'] = "instantbugfix";
        $portPages[$i]['Html'] = '<p>&nbsp;</p>';
        $portPages[$i]['Background'] = '/bundles/portfolio/images/projects/instantbugfix/home.png';
        
        $i++;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "instantbugfix/doel";
        $portPages[$i]['Html'] = '<h2>Wat was het doel?</h2><p>Maak een project om door te sturen naar potenti&euml;le werkgevers.</p>';
        
        $i++;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "instantbugfix/geleerd";
        $portPages[$i]['Html'] = '<h2>Wat heb ik geleerd?</h2><ul><li>Responsive design</li><li>Spoon library</li><li>Git</li></ul>';
       
        $i++;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "instantbugfix/live";
        $portPages[$i]['Html'] = '<h2>Bekijk het zelf!</h2><p><a href="http://instantbugfix.jeroened.be/" target="_blank">instantbugfix.jeroened.be</a></p><p><a href="http://git.jeroened.be/JeroenED/instant-bugfix" target="_blank">Git-project</a></p>';
       
        $dbItems[$it]->setPages(serialize($portPages));
        
        $dbItems[$it]->setRank(2);
                
        $it++; // Tuinhier
        $dbItems[$it] = new PortfolioItem();
        $dbItems[$it]->setTitle("Tuinhier Waregem");
        
        $portPages = null; $i = 0;
        $portPages[$i]['ShowTitle'] = false;
        $portPages[$i]['Slug'] = "tuinhier";
        $portPages[$i]['Html'] = '<p>&nbsp;</p>';
        $portPages[$i]['Background'] = '/bundles/portfolio/images/projects/tuinhier/home.png';
        
        $i++;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "tuinhier/doel";
        $portPages[$i]['Html'] = '<h2>Wat was het doel?</h2><p>Maak een nieuwe website voor onze vereniging, waarbij een lid zonder veel kennis de website kan bewerken</p>';
        
        $i++;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "tuinhier/geleerd";
        $portPages[$i]['Html'] = '<h2>Wat heb ik geleerd?</h2><ul><li>Zelf een CMS maken</li><li>CKeditor</li></ul>';
       
        $i++;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "tuinhier/live";
        $portPages[$i]['Html'] = '<h2>Bekijk het zelf!</h2><p><a href="http://www.tuinhierwaregem.be/" target="_blank">tuinhierwaregem.be</a></p>';
       
        $dbItems[$it]->setPages(serialize($portPages));
        $dbItems[$it]->setRank(3);
        
        $it++; // About Page
        $dbItems[$it] = new Page();
        $dbItems[$it]->setTitle('About');
        $dbItems[$it]->SetHtml('<ul><li>Design: Jeroen De Meerleer</li><li>Development: Jeroen De Meerleer</li></ul><h2>Gebruikte libraries</h2><ul><li><a href="http://lab.hakim.se/reveal-js/" target="_blank">Reveal.js</a></li><li><a href="http://jquery.com/" target="_blank">jQuery</a></li><li><a href="http://www.google.com/analytics/" target="_blank">Google Analytics</a></li><li><a href="https://github.com/malihu/malihu-custom-scrollbar-plugin" target="_blank">jQuery custom content scroller</a></li><li><a href="http://symfony.com" target="_blank">Symfony Framework</a></li></ul><p><a href="http://status.jeroened.be/" target="_blank">Check de server-status</a></p>');        
        $dbItems[$it]->setSlug('about');
        
        $it++; // Resume page
        $dbItems[$it] = new Page();
        $dbItems[$it]->setTitle('Curriculum Vitae');
        $dbItems[$it]->SetHtml('<h2>Personalia</h2><table><tr><th style="width:250px;">Naam:</th><td>Jeroen De Meerleer</td></tr><tr><th style="width:250px;">Adres:</th><td>Pijkstraat 61</td></tr><tr><th style="width:250px;">Gemeente:</th><td>Waregem</td></tr><tr><th style="width:250px;">Telefoon:</th><td>+32 (470) 62 20 88</td></tr><tr><th style="width:250px;">E-mail:</th><td><a href="mailto:&#109;&#101;&#064;&#106;&#101;&#114;&#111;&#101;&#110;&#101;&#100;&#046;&#098;&#101;">&#109;&#101;&#064;&#106;&#101;&#114;&#111;&#101;&#110;&#101;&#100;&#046;&#098;&#101;</a></td></tr><tr><th style="width:250px;">Website:</th><td><a href="http://www.jeroened.be/" target="_blank">www.jeroened.be</a></td></tr><tr><th style="width:250px;">Geboortedatum:</th><td>15 Oktober 1991</td></tr><tr><th style="width:250px;">Nationaliteit:</th><td>Belg</td></tr><tr><th style="width:250px;">In bezit van:</th><td>Rijbewijs B</td></tr></table><h2>Opleiding</h2><p>Heden: <strong>Graduaat Informatica - Programmeren</strong> HBO5 (CVO Pantha Rhei Gent)</p><p>Heden: <strong>Graduaat Informatica - Netwerkbeheer</strong> HBO5 (CVO Pantha Rhei Gent)</p><p>2012: <strong>Commercieel Webverkeer</strong> Se-n-Se (Hoger Professioneel Onderwijs Kortrijk)</p><p>2011: <strong>Kantooradministratie en Gegevensbeheer</strong> BSO (K.I. Spermalie Brugge)</p><h2>Talenkennis</h2><table><tr><td>&nbsp;</td><th>Spreken</th><th>Begrijpen</th><th>Lezen</th><th>Schrijven</th></tr><tr><th>Nederlands</th><td>Moedertaal</td><td>Moedertaal</td><td>Moedertaal</td><td>Moedertaal</td></tr><tr><th>Frans</th><td>Basis</td><td>Goed</td><td>Goed</td><td>Basis</td></tr><tr><th>Engels</th><td>Goed</td><td>Goed</td><td>Goed</td><td>Goed</td></tr></table><h2>Werkervaring</h2><p>09/2014 tot heden: Vrijwillig <strong>webmaster</strong> bij Schaakvereniging Luctor et Emergo</p><ul><li>Up-to-Date houden website kwsle.be in Joomla</li></ul><p>08/2014 tot 12/2014: <strong>Programmeur</strong> bij MeetMatch</p><ul><li>Verbeteren database</li><li>Algemeen systeembeheer met Linux</li></ul><p>09/2013 tot heden: Vrijwillig <strong>webmaster</strong> bij Vlaamse Schaakfederatie</p><ul><li>Website schaakfederatie.be aanpassen in Google Sites</li><li>Website schakenopschool.be aanpassen in Drupal</li></ul><p>11/2012 tot heden: Diverse <strong>Interims</strong> bij o.a Corex, Xilio, Delhaize, enz.</p><p>07/2012 tot heden: Vrijwillig <strong>webmaster</strong> bij Tuinhier Waregem</p><ul><li>opmaken en beheren van nieuwe website</li><li>nieuwsbrief opmaken en versturen</li></ul><p>(stage + vakantiejob) 05/2012 tot 09/2012: <strong>Web-Editor</strong> bij Renson nv</p><ul><li>E-mailtemplate voor Addemar aanmaken</li><li>Website aanpassen in Eyes-e-tools</li><li>Opzoeken van gegevens en geo-locatie projecten van Renson</li><li>Uitprogrammeren website ontbijtsessie.eu</li></ul><p>(stage) 11/2011 tot 12/2011: <strong>Web-Editor</strong> bij K.I. Spermalie</p><ul><li>Website aanpassen in HTML/CSS</li></ul><p>(vakantiejob) 08/2009 -2010-2011: <strong>Administratief bediende</strong> bij Stadsbestuur Waregem</p><ul><li>Digitaliseren van archiefstukken</li><li>Digitaliseren van milieuvergunningen</li></ul><p>(stage) 09/2010 tot 06/2011: <strong>Administratief bediende</strong> bij Wit-Gele kruis West-Vlaanderen</p><ul><li>Klasseren van dossiers</li><li>Algemeen bediendewerk</li></ul><p>(stage) 09/2009 tot 06/2010: <strong>Administratief bediende</strong> bij Stadsbestuur Brugge</p><ul><li>Klasseren van dossiers</li><li>Invoeren van oude dossiers in Cipal</li></ul><h2>Informaticakennis</h2>&nbsp;<table style="width: 100%"><caption>Besturingssystemen</caption><tr><th style="width: 25%">Windows</th><td style="width: 25%">Goed</td><th style="width: 25%">Windows Server</th><td style="width: 25%">Basis</td></tr><tr><th style="width: 25%">Linux</th><td style="width: 25%">Goed</td><td style="width: 25%">&nbsp;</td><td style="width: 25%">&nbsp;</td></tr></table><table style="width: 100%"><caption>Office Pakket</caption><tr><th style="width: 25%">Word</th><td style="width: 25%">Goed</td><th style="width: 25%">Excel</th><td style="width: 25%">Goed</td></tr><tr><th style="width: 25%">Powerpoint</th><td style="width: 25%">Goed</td><th style="width: 25%">Outlook</th><td style="width: 25%">Goed</td></tr><tr><th style="width: 25%">OneNote</th><td style="width: 25%">Goed</td><th style="width: 25%">&nbsp;</th><td style="width: 25%">&nbsp;</td></tr></table><table style="width: 100%"><caption>Creative Suite</caption><tr><th style="width: 25%">Photoshop</th><td style="width: 25%">Goed</td><th style="width: 25%">Dreamweaver</th><td style="width: 25%">Goed</td></tr><tr><th style="width: 25%">Illustrator</th><td style="width: 25%">Basis</td><th style="width: 25%">Acrobat</th><td style="width: 25%">Goed</td></tr></table><table style="width: 100%"><caption>Programmeertalen</caption><tr><th style="width: 25%">HTML</th><td style="width: 25%">Zeer goed</td><th style="width: 25%">PHP</th><td style="width: 25%">Goed</td></tr><tr><th style="width: 25%">CSS</th><td style="width: 25%">Goed</td><th style="width: 25%">MySQL</th><td style="width: 25%">Goed</td></tr><tr><th style="width: 25%">Javascript</th><td style="width: 25%">Basis</td><th style="width: 25%">Visual Basic</th><td style="width: 25%">Goed</td></tr></table><h2>Vrijetijdsbesteding</h2><p>Tijdens mijn vrije tijd ben ik actief in de schaaksport bij Luctor Et Emergo en ben ik webmaster bij meerdere verenigingen. Als ik niet bezig ben met schaken werk ik aan eigen projecten of ben ik aan het studeren voor de avondschool.</p>');        
        $dbItems[$it]->setSlug('resume');        
        
        $it++; // Contact page
        $dbItems[$it] = new Page();
        $dbItems[$it]->setTitle('Contact');
        $dbItems[$it]->SetHtml('<p>Omdat deze website op dit moment in aanbouw is er nog geen (werkend) contact-formulier. U kan hieronder mijn gegevens vinden waarmee u mij kan contacteren.</p><address><p class="name">Jeroen De Meerleer</p><p class="address"><span class="street">Pijkstraat 61</span><br><span class="postal-code">8790</span> <span class="city">Waregem</span><br><span class="country">België</span><br><span class="e-mail"><a href="mailto:&#109;&#101;&#064;&#106;&#101;&#114;&#111;&#101;&#110;&#101;&#100;&#046;&#098;&#101;">&#109;&#101;&#064;&#106;&#101;&#114;&#111;&#101;&#110;&#101;&#100;&#046;&#098;&#101;</a></span><br><span class="phone">+32 (470) 62 20 88</span><br></p></address><p>U kan mij ook altijd bereiken via de gepaste sociale media (zoek naar JeroenED of Jeroen De Meerleer)</p>');        
        $dbItems[$it]->setSlug('contact');
        
        
        $it++; // Blog Menu
        $dbItems[$it] = new MenuItem();
        $dbItems[$it]->setLabel("Blog");
        $dbItems[$it]->setDestination("https://iam.jeroened.be");
        $dbItems[$it]->setRank(1);
        
        $it++; // Resume Menu
        $dbItems[$it] = new MenuItem();
        $dbItems[$it]->setLabel("Resume");
        $dbItems[$it]->setDestination("resume");
        $dbItems[$it]->setRank(2);
        
        $it++; // Git Menu
        $dbItems[$it] = new MenuItem();
        $dbItems[$it]->setLabel("Git");
        $dbItems[$it]->setDestination("https://git.jeroened.be");
        $dbItems[$it]->setRank(3);
        
        $it++; // Contact Menu
        $dbItems[$it] = new MenuItem();
        $dbItems[$it]->setLabel("Contact");
        $dbItems[$it]->setDestination("contact");
        $dbItems[$it]->setRank(4);
        
        $it++; // About Menu
        $dbItems[$it] = new MenuItem();
        $dbItems[$it]->setLabel("About");
        $dbItems[$it]->setDestination("about");
        $dbItems[$it]->setRank(5);
        
        foreach($dbItems as $dbItem) {
            $manager->persist($dbItem);
        }
        $manager->flush();
    }
}
