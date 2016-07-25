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
        $dbItems[$it]->setTitle("Example-site");
        $dbItems[$it]->setArchived(false);
        $dbItems[$it]->setPages('[{"Slug":"example","Background":"","Html":"<h2>Welcome to this test-site<\/h2>","ShowTitle":true}]');       
        $dbItems[$it]->setRank(1);
                
        
        $it++; // Multipage example
        $dbItems[$it] = new PortfolioItem();
        $dbItems[$it]->setTitle("Multipage example");
        $dbItems[$it]->setArchived(false);
        $dbItems[$it]->setPages('[{"Slug":"multi-example","Background":"","Html":"<p>This is a multi-page example.<p><p>Please use the down-arrow to go to the next page<\/p>","ShowTitle":true},{"Slug":"multi-example-second","Background":"","Html":"<p>This is our second page.<\/p>","ShowTitle":true}]');
        
        $dbItems[$it]->setRank(2);        
        
        $it++; // Other examples
        $dbItems[$it] = new PortfolioItem();
        $dbItems[$it]->setTitle("Other examples");
        $dbItems[$it]->setArchived(false);
        $dbItems[$it]->setPages('[{"ShowTitle":true,"Slug":"background-example","Html":"<p style=\"color:#000000;\">You can change the background<\/p>","Background":"/bundles/jeroenedportfolio/images/brushed.png"},{"ShowTitle":true,"Slug":"html-example","Html":"<p>You can use <strong>all<\/strong> HTML <em>you<\/em> like.<\/p> <ul><li>Even bullets,<ol><li>Nested lists<\/li><li>and numbers<\/li>/<ol><\/li><\/p>"},{"ShowTitle":true,"Slug":"notitle-example","Html":"<p>Check this out! No title!<\/p>"}]');      
        $dbItems[$it]->setRank(3);
                
        $it++; // Archived
        $dbItems[$it] = new PortfolioItem();
        $dbItems[$it]->setTitle("Archived example");
        $dbItems[$it]->setArchived(false);
        $dbItems[$it]->setPages('[{"ShowTitle":true,"Slug":"archived-example","Html":"<p>By assigning the archived flag the item is not visible on the main page.<\/p>","Background":""}]');
        $dbItems[$it]->setRank(4);
        
        $it++; // Help Page
        $dbItems[$it] = new Page();
        $dbItems[$it]->setTitle('Help');
        $dbItems[$it]->setSlug('help');
        $dbItems[$it]->SetHtml('<p>Pages are displayed using a sort-of popup and are loaded through ajax.</p><p>Links to <a href="/example2">other pages</a> are subsequently loaded through ajax and displayed in a popup.</p><p>links to <a href="http://www.duckduckgo.com</a>other sites</a> are loaded in a new window or tab.<p><ul><li>Design: Jeroen De Meerleer</li><li>Development: Jeroen De Meerleer</li></ul><h2>Gebruikte libraries</h2><ul><li><a href="http://lab&#x2E;hakim&#x2E;se/reveal&#x2D;js/" target="&#x5F;blank">Reveal&#x2E;js</a></li><li><a href="http://jquery&#x2E;com/" target="&#x5F;blank">jQuery</a></li><li><a href="http://www&#x2E;google&#x2E;com/analytics/" target="&#x5F;blank">Google Analytics</a></li><li><a href="https://github&#x2E;com/malihu/malihu&#x2D;custom&#x2D;scrollbar&#x2D;plugin" target="&#x5F;blank">jQuery custom content scroller</a></li><li><a href="http://symfony&#x2E;com" target="&#x5F;blank">Symfony Framework</a></li></ul><h2>Credits</h2><ul><li>Standaard achtergrond: <a href="http://subtlepatterns&#x2E;com/" target="&#x5F;blank">Subtle Patterns</a></li><li>Iconen: <a href="http://iconmonstr&#x2E;com/" target="&#x5F;blank">Iconmonstr</a></li><li>Lettertype: <a href="https://www&#x2E;google&#x2E;com/fonts/specimen/Source+Sans+Pro" target="&#x5F;blank">Source Sans Pro</a></li></ul><p><a href="http://status&#x2E;jeroened&#x2E;be/">Check de server&#x2D;status</a></p><p><a href="/archive">Gearchiveerde items</a></p>');
        
        $it++; // Help menu
        $dbItems[$it] = new MenuItem();
        $dbItems[$it]->setLabel("Help");
        $dbItems[$it]->setDestination("/help");
        $dbItems[$it]->setRank(1);
               
        foreach($dbItems as $dbItem) {
            $manager->persist($dbItem);
        }
        $manager->flush();
    }
}
