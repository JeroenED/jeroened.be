<?php
namespace JeroenED\PortfolioBundle\Entity;

/**
 * Description of Portfolio
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="portfolio")
 */

class PortfolioItem {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     *
     * @ORM\Column(type="string", length=50)
     */
    protected $title;
    
    /**
     *
     * @ORM\Column(type="text") 
     */
    protected $pages;
    
    /**
     * 
     * @ORM\Column(type="integer")
     */
    protected $rank;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Portfolio
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set pages
     *
     * @param string $pages
     * @return Portfolio
     */
    public function setPages($pages)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * Get pages
     *
     * @return string 
     */
    public function getPages()
    {
        return $this->pages;
    }


 
    /**
     * Set rank
     *
     * @param integer $rank
     * @return PortfolioItem
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer 
     */
    public function getRank()
    {
        return $this->rank;
    }
}
