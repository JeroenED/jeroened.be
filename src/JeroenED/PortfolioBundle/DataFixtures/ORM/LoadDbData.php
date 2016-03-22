<?php
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
        $portPages[$i]['Slug'] = "portfolio";
        $portPages[$i]['Html'] = '<p><img alt="Jeroen De Meerleer" src="/bundles/jeroenedportfolio/images/jeroened_2015.png" style="float: right;" /></p><h1>Jeroen De Meerleer</h1><h2>Developer-Operator</h2><p class="nomobile" style="font-size:8px">Gebruik de pijltjes om mijn portfolio weer te geven.</p><p class="mobile">Swipe om mijn portfolio weer te geven.</p>';
        
        $i++;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "portfolio-doel";
        $portPages[$i]['Html'] = '<h2>Wat was het doel?</h2><p>Maak een eindwerk waarbij je uzelf en uw projecten virtueel tentoon stelt</p>';
        
        $i++;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "portfolio-geleerd";
        $portPages[$i]['Html'] = '<h2>Wat heb ik geleerd?</h2><ul><li>Symfony Framework</li><li>Model-View-Controller principe</li><li>Composer</li><li>Sass</li><li>Media=Print</li>';     
        
        $i++;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "portfolio-live";
        $portPages[$i]['Html'] = '<h2>Bekijk het zelf!</h2><p><a href="http://www.jeroened.be" target="_blank">JeroenED.be</a></p><p><a href="http://git.jeroened.be/jeroened/website.git" target="_blank">Git-Project</a></p><p><a href="https://downloads.jeroened.be/projectwerk.pdf" target="_blank">Scriptie</a></p><p><a href="https://presto.jeroened.be/projectwerk" target="_blank">Presentatie</a></p>';
        
        $dbItems[$it]->setPages(json_encode($portPages));                
        $dbItems[$it]->setRank(1);
                
        
        $it++; // Instant Bugfix
        $dbItems[$it] = new PortfolioItem();
        $dbItems[$it]->setTitle("Instant Bugfix");
        
        $portPages = null; $i = 0;
        $portPages[$i]['ShowTitle'] = false;
        $portPages[$i]['Slug'] = "instantbugfix";
        $portPages[$i]['Html'] = '<p>&nbsp;</p>';
        $portPages[$i]['Background'] = '/bundles/jeroenedportfolio/images/projects/instantbugfix/home.png';
        
        $i++;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "instantbugfix-doel";
        $portPages[$i]['Html'] = '<h2>Wat was het doel?</h2><p>Maak een project om door te sturen naar potenti&euml;le werkgevers.</p>';
        
        $i++;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "instantbugfix-geleerd";
        $portPages[$i]['Html'] = '<h2>Wat heb ik geleerd?</h2><ul><li>Responsive design</li><li>Spoon library</li><li>Git</li></ul>';
       
        $i++;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "instantbugfix-live";
        $portPages[$i]['Html'] = '<h2>Bekijk het zelf!</h2><p><a href="http://instantbugfix.jeroened.be/" target="_blank">instantbugfix.jeroened.be</a></p><p><a href="http://git.jeroened.be/JeroenED/instant-bugfix" target="_blank">Git-project</a></p>';
       
        $dbItems[$it]->setPages(json_encode($portPages));
        
        $dbItems[$it]->setRank(2);
                
        $it++; // Tuinhier
        $dbItems[$it] = new PortfolioItem();
        $dbItems[$it]->setTitle("Tuinhier Waregem");
        
        $portPages = null; $i = 0;
        $portPages[$i]['ShowTitle'] = false;
        $portPages[$i]['Slug'] = "tuinhier";
        $portPages[$i]['Html'] = '<p>&nbsp;</p>';
        $portPages[$i]['Background'] = '/bundles/jeroenedportfolio/images/projects/tuinhier/home.png';
        
        $i++;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "tuinhier-doel";
        $portPages[$i]['Html'] = '<h2>Wat was het doel?</h2><p>Maak een nieuwe website voor onze vereniging, waarbij een lid zonder veel kennis de website kan bewerken</p>';
        
        $i++;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "tuinhier-geleerd";
        $portPages[$i]['Html'] = '<h2>Wat heb ik geleerd?</h2><ul><li>Zelf een CMS maken</li><li>CKeditor</li></ul>';
       
        $i++;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "tuinhier-live";
        $portPages[$i]['Html'] = '<h2>Bekijk het zelf!</h2><p><a href="http://www.tuinhierwaregem.be/" target="_blank">tuinhierwaregem.be</a></p>';
       
        $dbItems[$it]->setPages(json_encode($portPages));
        $dbItems[$it]->setRank(3);
        
        
        $it++; // What's next
        $dbItems[$it] = new PortfolioItem();
        $dbItems[$it]->setTitle("What's next?");
        
        $portPages = null; $i = 0;
        $portPages[$i]['ShowTitle'] = true;
        $portPages[$i]['Slug'] = "whatsnext";
        $portPages[$i]['Html'] = '<ul><li><a href="https://git.jeroened.be/jeroened/presto.git" target="_blank">Presto</a></li>	<li><a href="https://git.jeroened.be/jeroened/sendit" target="_blank">SendIT</a></li></ul><p>En laat ons hopen dat het daar niet bij blijft.</p>';
        
        $dbItems[$it]->setPages(json_encode($portPages));
        $dbItems[$it]->setRank(4);
        
        $it++; // About Page
        $dbItems[$it] = new Page();
        $dbItems[$it]->setTitle('About');
        $dbItems[$it]->SetHtml('<ul><li>Design: Jeroen De Meerleer</li><li>Development: Jeroen De Meerleer</li></ul><h2>Gebruikte libraries</h2><ul><li><a href="http://lab.hakim.se/reveal-js/" target="_blank">Reveal.js</a></li><li><a href="http://jquery.com/" target="_blank">jQuery</a></li><li><a href="http://www.google.com/analytics/" target="_blank">Google Analytics</a></li><li><a href="https://github.com/malihu/malihu-custom-scrollbar-plugin" target="_blank">jQuery custom content scroller</a></li><li><a href="http://symfony.com" target="_blank">Symfony Framework</a></li></ul><h2>Credits</h2><ul><li>Standaard achtergrond: <a href="http://subtlepatterns.com/" target="_blank">Subtle Patterns</a></li><li>Lettertype: <a href="https://www.google.com/fonts/specimen/Open+Sans">Open Sans</a></li></ul><p><a href="http://status.jeroened.be/" target="_blank">Check de server-status</a></p>');        
        $dbItems[$it]->setSlug('about');
        
        $it++; // Resume page
        $dbItems[$it] = new Page();
        $dbItems[$it]->setTitle('Curriculum Vitae');
        $dbItems[$it]->SetHtml('<p class="noprint"><a href="javascript:openPage(\'resume-eng\');">English version</a> | <a href="javascript:openPage(\'resume-fra\');">Version fran&ccedil;aise</a></p><p><img alt="" src="/bundles/jeroenedportfolio/images/jeroened_2015.png" style="float: right;" /></p><h2>Personalia</h2><table id="personalia"><tbody><tr><th>Naam:</th><td>Jeroen De Meerleer</td></tr><tr><th>Adres:</th><td>Pijkstraat 61</td></tr><tr><th>Gemeente:</th><td>Waregem</td></tr><tr><th>Telefoon:</th><td><span class="baec5a81-e4d6-4674-97f3-e9220f0136c1" style="white-space: nowrap;">+32 (470) 62 20 88</span></td></tr><tr><th>E-mail:</th><td><a href="mailto:me@jeroened.be">me@jeroened.be</a></td></tr><tr><th>Website:</th><td><a href="http://www.jeroened.be/" target="_blank">www.jeroened.be</a></td></tr><tr><th>Geboortedatum:</th><td>15 Oktober 1991</td></tr><tr><th>Nationaliteit:</th><td>Belg</td></tr><tr><th>In bezit van:</th><td>Rijbewijs B</td></tr></tbody></table><h2>Opleiding</h2><p>2015: <strong>Graduaat Informatica - Netwerkbeheer</strong> HBO5 (CVO Pantha Rhei Gent)</p><p>2012: <strong>Commercieel Webverkeer</strong> Se-n-Se (Hoger Professioneel Onderwijs Kortrijk)</p><p>2011: <strong>Kantooradministratie en Gegevensbeheer</strong> BSO (K.I. Spermalie Brugge)</p><h2>Vaardigheden</h2><ul><li>Het office-pakket en de creatieve suite ken ik uit mijn duimpje</li><li>Nieuwe programma&rsquo;s aanleren gaat zeer vlot.</li><li>Ik kan samenwerken met anderen en werk heel nauwkeurig.</li><li>Flexibel</li></ul><p>.</p><h2>Talenkennis</h2><table class="table-mobile" id="languages"><thead><tr><th>&nbsp;</th><th>Spreken</th><th>Begrijpen</th><th>Lezen</th><th>Schrijven</th></tr></thead><tbody><tr><th>Nederlands</th><td>Moedertaal</td><td>Moedertaal</td><td>Moedertaal</td><td>Moedertaal</td></tr><tr><th>Frans</th><td>Basis</td><td>Goed</td><td>Goed</td><td>Basis</td></tr><tr><th>Engels</th><td>Goed</td><td>Goed</td><td>Goed</td><td>Goed</td></tr></tbody></table><h2>Werkervaring</h2><p>08/2015 tot heden: <strong>Support engineer </strong>bij HP CDS</p><ul><li>First-Line helpdesk bij Bekaert, Zwevegem</li></ul><p>09/2014 tot heden: Vrijwillig <strong>webmaster</strong> bij Schaakvereniging Luctor et Emergo</p><ul><li>Up-to-Date houden website kwsle.be in joomla</li></ul><p>08/2014 tot 12/2014: <strong>Programmeur</strong> bij MeetMatch</p><ul><li>Verbeteren database</li><li>Algemeen systeembeheer met Linux</li></ul><p>09/2013 tot heden: Vrijwillig <strong>webmaster</strong> bij Vlaamse Schaakfederatie</p><ul><li>Website schaakfederatie.be aanpassen in Google Sites</li><li>Website schakenopschool.be aanpassen in Drupal</li></ul><p>11/2012 tot 08/2015: Diverse <strong>Interims</strong> bij o.a Corex, Xilio, Delhaize, enz.</p><p>07/2012 tot heden: Vrijwillig <strong>webmaster</strong> bij Tuinhier Waregem</p><ul><li>Opmaken en beheren nieuwe website</li><li>Nieuwsbrief opmaken en versturen</li></ul><p>(stage + vakantiejob) 05/2012 tot 09/2012: <strong>Web-Editor</strong> bij Renson nv</p><ul><li>E-mailtemplate voor Addemar aanmaken</li><li>Website aanpassen in Eyes-E-Tools</li><li>Opzoeken van gegevens en geo-locatie projecten van Renson</li><li>Uitprogrammeren website ontbijtsessie.be</li></ul><p>(stage) 11/2011 tot 12/2011: <strong>Web-Editor</strong> bij K.I. Spermalie</p><ul><li>Website aanpassen in HTML/CSS</li></ul><p>(vakantiejob) 08/2009 -2010-2011: <strong>Administratief bediende</strong> bij Stadsbestuur Waregem</p><ul><li>Digitaliseren van archiefstukken</li><li>Digitaliseren van milieuvergunningen</li></ul><p>(stage) 09/2010 tot 06/2011: <strong>Administratief bediende</strong> bij Wit-Gele kruis West-Vlaanderen</p><ul><li>Klasseren van dossiers</li><li>Algemeen bediendewerk</li></ul><p>(stage) 09/2009 tot 06/2010: <strong>Administratief bediende</strong> bij Stadsbestuur Brugge</p><ul><li>Klasseren van dossiers</li><li>Invoeren van oude dossiers in Cipal</li></ul><h2>Informaticakennis</h2><p>&nbsp;</p><table class="cv-informatics"><caption>Besturingssystemen</caption><tbody><tr><th>Windows</th><td>Goed</td><th>Windows Server</th><td>Basis</td></tr><tr><th>Linux</th><td>Goed</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table><table class="cv-informatics"><caption>Office Pakket</caption><tbody><tr><th>Word</th><td>Goed</td><th>Excel</th><td>Goed</td></tr><tr><th>Powerpoint</th><td>Goed</td><th>Outlook</th><td>Goed</td></tr><tr><th>OneNote</th><td>Goed</td><th>&nbsp;</th><td>&nbsp;</td></tr></tbody></table><table class="cv-informatics"><caption>Creative Suite</caption><tbody><tr><th>Photoshop</th><td>Goed</td><th>Dreamweaver</th><td>Goed</td></tr><tr><th>Illustrator</th><td>Basis</td><th>Acrobat</th><td>Goed</td></tr></tbody></table><table class="cv-informatics"><caption>Programmeertalen</caption><tbody><tr><th>HTML</th><td>Zeer goed</td><th>CSS</th><td>Goed</td></tr><tr><th>PHP</th><td>Goed</td><th>MySQL</th><td>Goed</td></tr><tr><th>Javascript</th><td>Basis</td><th>Visual Basic</th><td>Goed</td></tr></tbody></table><h2>Vrijetijdsbesteding</h2><p>Tijdens mijn vrije tijd ben ik actief in de schaaksport zowel online als bij de lokale schaakvereniging Luctor et Emergo. Daarnaast ben ik webmaster van verschillende verenigingen. Als ik niet bezig ben met schaken werk ik aan eigen projecten of zit ik vastgekluisterd aan mijn radio.</p><h2>Referenties</h2><p><strong>Bert Van Vreckem</strong>&nbsp;Leerkracht&nbsp;CVO Panta Rhei, <a href="mailto:bert.vanvreckem@avondschool.be">bert.vanvreckem@avondschool.be</a></p>');
        $dbItems[$it]->setSlug('resume');        
        
        $it++; // Contact page
        $dbItems[$it] = new Page();
        $dbItems[$it]->setTitle('Contact');
        $dbItems[$it]->SetHtml('<p>Jeroen De Meerleer</p><address>Pijkstraat 61<br />8790 Waregem<br />Belgi&euml;<br /><a href="mailto:me@jeroened.be">me@jeroened.be</a><br />+32 (470) 62 20 88</address><p>U kan uw berichten beveiligen met mijn&nbsp;<a href="https://downloads.jeroened.be/me_jeroened.be.pgp">publieke sleutel</a></p><p>Contacteren kan ook via <a href="javascript:OpenPage(\'social-media\');">Sociale Media</a></p>');        
        $dbItems[$it]->setSlug('contact');
        
        $it++; // English resume page
        $dbItems[$it] = new Page();
        $dbItems[$it]->setTitle('Resume');
        $dbItems[$it]->SetHtml('<p><img alt="" src="/bundles/jeroenedportfolio/images/jeroened_2015.png" style="float: right;" /></p><h2>Personal information</h2><table id="personalia"><tbody><tr><th>Name:</th><td>Jeroen De Meerleer</td></tr><tr><th>Address:</th><td>Pijkstraat 61</td></tr><tr><th>City:</th><td>Waregem</td></tr><tr><th>Country:</th><td>Belgium</td></tr><tr><th>Phone:</th><td>32 (470) 62 20 88</td></tr><tr><th>E-mail:</th><td><a href="mailto:me@jeroened.be">me@jeroened.be</a></td></tr><tr><th>Website:</th><td><a href="http://www.jeroened.be/" target="_blank">www.jeroened.be</a></td></tr><tr><th>Date of birth:</th><td>October, 15&nbsp;1991</td></tr><tr><th>Nationality:</th><td>Belgian</td></tr><tr><th>In possesion of:</th><td>European driving licence B</td></tr></tbody></table><h2>Education</h2><p>2015: <strong>Graduate Computer science - Networking </strong>HBO5 (CVO Pantha Rhei Gent)</p><p>2012: <strong>Commercial Web</strong> Se-n-Se (Hoger Professioneel Onderwijs Kortrijk)</p><p>2011: <strong>Office- and data-management </strong>BSO (K.I. Spermalie Brugge)</p><h2>Skills</h2><ul><li>I have a good knowlegde of the Office suite and the Creative Suite</li><li>I can easily learn new applications</li><li>I am able to work with others and precise</li><li>Flexible</li></ul><h2>Languages</h2><table class="table-mobile" id="languages"><thead><tr><th>&nbsp;</th><th>Speaking</th><th>Understanding</th><th>Reading</th><th>Writing</th></tr></thead><tbody><tr><th>Dutch</th><td>Native</td><td>Native</td><td>Native</td><td>Native</td></tr><tr><th>French</th><td>Basic</td><td>Good</td><td>Good</td><td>Basic</td></tr><tr><th>English</th><td>Good</td><td>Good</td><td>Good</td><td>Good</td></tr></tbody></table><h2>Werkervaring</h2><p>08/2015 until present: <strong>Support engineer </strong>at HP CDS</p><ul><li>1<sup>st </sup>Line&nbsp;at Bekaert, Zwevegem</li></ul><p>09/2014 until present:&nbsp;Voluntary <strong>webmaster</strong>&nbsp;at&nbsp;Chessclub&nbsp;Luctor et Emergo</p><ul><li>Keep to the website kwsle.be up-to-date in Joomla</li></ul><p>08/2014&nbsp;until 12/2014: <strong>Programmer</strong>&nbsp;at MeetMatch</p><ul><li>Improving&nbsp;database</li><li>General system administration in Linux</li></ul><p>09/2013 until present:&nbsp;Voluntary <strong>webmaster</strong> bij Flemish Chess Federation</p><ul><li>Keeping website schaakfederatie.be&nbsp;up-to-date in Google Sites</li><li>Keeping website schakenopschool.be&nbsp;up-to-date&nbsp;in Drupal</li></ul><p>11/2012&nbsp;until 08/2015: Several <strong>Interims</strong>&nbsp;at Corex, Xilio, Delhaize, etc.</p><p>07/2012 until present:&nbsp;Voluntary <strong>webmaster</strong>&nbsp;at Tuinhier Waregem</p><ul><li>Programming and managing the new website</li><li>Creating and sending the monthly newsletter</li></ul><p>(Internship + student job) 05/2012&nbsp;until 09/2012: <strong>Web-Editor</strong> at Renson nv</p><ul><li>Creating e-mail template for Addemar</li><li>Updating corporate websites in Eyes-E-Tools</li><li>Looking up GPS coordinates and other relevant data of company projects</li><li>Programming&nbsp;website ontbijtsessie.eu</li></ul><p>(Internship) 11/2011 tot 12/2011: <strong>Web-Editor</strong>&nbsp;at K.I. Spermalie</p><ul><li>Updating and improving corporate website in&nbsp;HTML/CSS</li></ul><p>(Student job) 08/2009 -2010-2011: <strong>Administrative&nbsp;clerk</strong>&nbsp;at local government Waregem</p><ul><li>Digitalizing archives</li><li>Digitalizing environmental permits</li></ul><p>(Internship) 09/2010&nbsp;until 06/2011: <strong>Administrative&nbsp;clerk</strong>&nbsp;at Wit-Gele kruis West-Vlaanderen</p><ul><li>Filing files of patients</li><li>General operating work</li></ul><p>(stage) 09/2009&nbsp;until 06/2010: <strong>Administrative&nbsp;clerk</strong> bij local government Bruges</p><ul><li>Filing done files</li><li>Registering old permits in Cipal</li></ul><h2>Computer knowledge</h2><table class="cv-informatics"><caption>Operating systems</caption><tbody><tr><th>Windows</th><td>Good</td><th>Windows Server</th><td>Basic</td></tr><tr><th>Linux</th><td>Good</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table><table class="cv-informatics"><caption>Office Suite</caption><tbody><tr><th>Word</th><td>Good</td><th>Excel</th><td>Good</td></tr><tr><th>Powerpoint</th><td>Good</td><th>Outlook</th><td>Good</td></tr><tr><th>OneNote</th><td>Good</td><th>&nbsp;</th><td>&nbsp;</td></tr></tbody></table><table class="cv-informatics"><caption>Creative Suite</caption><tbody><tr><th>Photoshop</th><td>Good</td><th>Dreamweaver</th><td>Good</td></tr><tr><th>Illustrator</th><td>Basic</td><th>Acrobat</th><td>Good</td></tr></tbody></table><table class="cv-informatics"><caption>Programming languages</caption><tbody><tr><th>HTML</th><td>Very&nbsp;good</td><th>CSS</th><td>Good</td></tr><tr><th>PHP</th><td>Good</td><th>MySQL</th><td>Good</td></tr><tr><th>Javascript</th><td>Basic</td><th>Visual Basic</th><td>Good</td></tr></tbody></table><h2>Vrijetijdsbesteding</h2><p>In my spare time I am an active chess player online as well as in the local chess club Luctor et Emergo. Besides being a chess player I am also webmaster of several local organisations. When not playing chess or managing websites I am working personal projects that comes to my mind.</p><h2>Referenties</h2><p><strong>Bert Van Vreckem</strong>&nbsp;Lecturer&nbsp;CVO Panta Rhei, <a href="mailto:bert.vanvreckem@avondschool.be">bert.vanvreckem@avondschool.be</a></p>');        
        $dbItems[$it]->setSlug('resume-eng');
        
        $it++; // French resume page
        $dbItems[$it] = new Page();
        $dbItems[$it]->setTitle('Curriculum Vitae');
        $dbItems[$it]->SetHtml('<p><img alt="" src="/bundles/jeroenedportfolio/images/jeroened_2015.png" style="float: right;" /></p><h2>Renseignements personels</h2><table id="personalia"><tbody><tr><th>Nom:</th><td>Jeroen De Meerleer</td></tr><tr><th>Adresse:</th><td>Pijkstraat 61</td></tr><tr><th>Ville:</th><td>Waregem</td></tr><tr><th>Pays:</th><td>Belgium</td></tr><tr><th>Numero de t&eacute;l&eacute;phone:</th><td>+32 (470) 62 20 88</td></tr><tr><th>E-mail:</th><td><a href="mailto:me@jeroened.be">me@jeroened.be</a></td></tr><tr><th>Site web:</th><td><a href="http://www.jeroened.be/" target="_blank">www.jeroened.be</a></td></tr><tr><th>Date de naissance:</th><td>15 Octobre&nbsp;1991</td></tr><tr><th>Nationalit&eacute;:</th><td>Belge</td></tr><tr><th>En&nbsp;possesion de:</th><td>Permis de conduire europ&eacute;en B</td></tr></tbody></table><h2>Formation</h2><p>2015: Dipl&ocirc;me d&#39;associ&eacute; <strong>Informatique - Gestion de r&eacute;seau</strong> (CVO Pantha Rhei Gand)</p><p>2012: <strong>Web Commercial</strong> Se-n-Se (Hoger Professioneel Onderwijs Courtrai)</p><p>2011: <strong>Administration et gestion des donn&eacute;es</strong> BSO (K.I. Spermalie Bruges)</p><h2>Comp&eacute;tences</h2><ul><li>J&#39;ai de&nbsp;bonnes connaissances de suite office et suite creative</li><li>J&#39;apprends tr&egrave;s vite des nouvelles&nbsp;applications</li><li>Je suis capable de&nbsp;travailler en &eacute;quipe et avec pr&eacute;cision</li><li>Flexible</li></ul><h2>Langues</h2><table class="table-mobile" id="languages"><thead><tr><th>&nbsp;</th><th>A parler</th><th>A comprendre</th><th>A lire</th><th>A &eacute;crire</th></tr></thead><tbody><tr><th>n&eacute;erlandais</th><td>Langue maternelle</td><td>Langue maternelle</td><td>Langue maternelle</td><td>Langue maternelle</td></tr><tr><th>fran&ccedil;ais</th><td>Base</td><td>Bien</td><td>Bien</td><td>Base</td></tr><tr><th>anglais</th><td>Bien</td><td>Bien</td><td>Bien</td><td>Bien</td></tr></tbody></table><h2>Exp&eacute;rience professionelles</h2><p>08/2015 jusqu&#39;&agrave; pr&eacute;sent: <strong>Operateur helpdesk</strong> chez HP CDS</p><ul><li>1<sup>ier</sup> Ligne chez Bekaert, Zwevegem</li></ul><p>09/2014 jusqu&#39;&agrave; pr&eacute;sent: <strong>Webmaster</strong> voluntaire chez le&nbsp;club des &eacute;checs Luctor et Emergo</p><ul><li>Mise &agrave; jour du site web kwsle.be en Joomla</li></ul><p>08/2014 jusqu&#39;&agrave; 12/2014: <strong>Programmeur</strong> chez MeetMatch</p><ul><li>Improving&nbsp;database</li><li>Administration general des syst&egrave;mes en Linux</li></ul><p>09/2013 jusqu&#39;&agrave;&nbsp;pr&eacute;sent:&nbsp;<strong>webmaster</strong> voluntaire chez la f&eacute;d&eacute;ration des &eacute;checs flamande</p><ul><li>Mise &agrave; jour du site web schaakfederatie.be en Google Sites</li><li>Mise &agrave; jour du site web schakenopschool.be en Drupal</li></ul><p>11/2012&nbsp;jusqu&#39;&agrave; 08/2015: <span style="line-height: 20.8px;">diff&eacute;rentes&nbsp;</span><strong>Int&eacute;rims</strong>&nbsp; chez Corex, Xilio, Delhaize, etc.</p><p>07/2012 jusqu&#39;&agrave; pr&eacute;sent:&nbsp;<strong>webmaster</strong>&nbsp;voluntaire&nbsp;chez Tuinhier Waregem</p><ul><li>Programmeur et mise&nbsp;en &agrave; jour du&nbsp;nouveau site web</li><li>Cr&eacute;er&nbsp;en envoyer les bulletins d&#39;information</li></ul><p>(Stage + job &eacute;tudiant) 05/2012&nbsp;jusqu&#39;&agrave; 09/2012: <strong>Web-Editor</strong>&nbsp;chez Renson nv</p><ul><li>Cr&eacute;er des&nbsp;mod&egrave;les e-mail pour Addemar</li><li>Mise &agrave;&nbsp;jour des sites web de la firme en Eyes-E-Tools</li><li>Chercher&nbsp;coordonn&eacute;es GPS et d&#39;autre donn&eacute;es relevant des&nbsp;projects&nbsp;de la&nbsp;firme&nbsp;</li><li>Programmeur du site web&nbsp;ontbijtsessie.eu</li></ul><p>(Stage) 11/2011 jusqu&#39;&agrave; 12/2011: <strong>Web-Editor</strong>&nbsp;chez K.I. Spermalie</p><ul><li>Mise &agrave;&nbsp;jour du site web&nbsp;de l&#39;&eacute;cole en HTML et CSS</li></ul><p>(Job &eacute;tudiant) 08/2009-2010-2011: <strong>Assistant administratif</strong>&nbsp;chez &agrave; l&#39;h&ocirc;tel de ville&nbsp;de la ville Waregem</p><ul><li>Digitaliser les archives</li><li>Digitaliser les permis environnementaux</li></ul><p>(Stage) 09/2010&nbsp;jusqu&#39;&agrave; 06/2011: <strong>Assistant administratif</strong>&nbsp;chez Wit-Gele kruis West-Vlaanderen</p><ul><li>Trier les dossiers des patients</li><li>Travail de commis g&eacute;n&eacute;ral</li></ul><p>(Stage) 09/2009&nbsp;<span style="line-height: 20.8px;">jusqu&#39;&agrave;</span> 06/2010: <strong>Assistant administratif</strong> chez h&ocirc;tel de ville Bruges</p><ul><li>Trier les dossiers finis</li><li>Enregistrer les&nbsp;<span style="line-height: 20.8px;">vieux&nbsp;</span>dosiers&nbsp;en Cipal</li></ul><h2>Connaissances d&#39;ordinateur</h2><table class="cv-informatics"><caption>Syst&egrave;me d&#39;exploitation</caption><tbody><tr><th>Windows</th><td>Bien</td><th>Windows Server</th><td>Base</td></tr><tr><th>Linux</th><td>Bien</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table><table class="cv-informatics"><caption>Suite d&#39;office</caption><tbody><tr><th>Word</th><td>Bien</td><th>Excel</th><td>Bien</td></tr><tr><th>Powerpoint</th><td>Bien</td><th>Outlook</th><td>Bien</td></tr><tr><th>OneNote</th><td>Bien</td><th>&nbsp;</th><td>&nbsp;</td></tr></tbody></table><table class="cv-informatics"><caption>Suite creative</caption><tbody><tr><th>Photoshop</th><td>Bien</td><th>Dreamweaver</th><td>Bien</td></tr><tr><th>Illustrator</th><td>Base</td><th>Acrobat</th><td>Bien</td></tr></tbody></table><table class="cv-informatics"><caption>Langues &agrave; programmer</caption><tbody><tr><th>HTML</th><td>Tr&egrave;s bien</td><th>CSS</th><td>Bien</td></tr><tr><th>PHP</th><td>Bien</td><th>MySQL</th><td>Bien</td></tr><tr><th>Javascript</th><td>Base</td><th>Visual Basic</th><td>Bien</td></tr></tbody></table><h2>Loisirs</h2><p>Je joue aux&nbsp;&eacute;checs online&nbsp;et au club des &eacute;checs local Luctor et Emergo. En plus, je suis&nbsp;webmaster des orginisations differentes locales. Si je ne joue pas aux &eacute;checs ou je ne fait pas de&nbsp;mises a jour&nbsp;des site web, je travaille au projects differentes qui me viennent &agrave; l&#39;esprit.</p><h2>R&eacute;ferences</h2><p><strong>Bert Van Vreckem</strong>&nbsp;professeur&nbsp;CVO Panta Rhei, <a href="mailto:bert.vanvreckem@avondschool.be">bert.vanvreckem@avondschool.be</a></p>');        
        $dbItems[$it]->setSlug('resume-fra');
        
        
        $it++; // French resume page
        $dbItems[$it] = new Page();
        $dbItems[$it]->setTitle('Social Media');
        $dbItems[$it]->SetHtml('<p>Dit zijn mijn sociale media accounts. Use them wisely</p><ul><li><a href="http://www.twitter.com/JeroenED" target="_blank">Twitter</a></li><li><a href="https://www.facebook.com/jeroened.be" target="_blank">Facebook</a></li><li><a href="https://instagram.com/jeroened_be/" target="_blank">Instagram</a></li><li><a href="https://be.linkedin.com/in/jeroened" target="_blank">LinkedIn</a></li><li><a href="https://foursquare.com/jeroened" target="_blank">Foursquare</a></li></ul>');        
        $dbItems[$it]->setSlug('social-media');
        
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
