<?php
namespace JeroenED\PortfolioBundle\Entity;

/**
 * This is the database-layout for the pages-table
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pages")
 */

class Page {
    
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
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    protected $download;
    
    /**
     *
     * @ORM\Column(type="text") 
     */
    protected $html;
    
    /**
     * 
     * @ORM\Column(type="string", length=50, unique=true)
     */
    protected $slug;

    

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
     * @return Page
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
     * Set download
     *
     * @param string $download
     * @return Page
     */
    public function setDownload($download)
    {
        $this->Download = $download;

        return $this;
    }

    /**
     * Get download
     *
     * @return string 
     */
    public function getDownload()
    {
        return $this->download;
    }

    /**
     * Set html
     *
     * @param string $html
     * @return Page
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Get html
     *
     * @return string 
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Page
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
