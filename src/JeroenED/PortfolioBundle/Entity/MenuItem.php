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
 * @ORM\Table(name="menu")
 */

class MenuItem {
    
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
    protected $label;
    
    /**
     *
     * @ORM\Column(type="string", length=100) 
     */
    protected $destination;

    /**
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
     * Set label
     *
     * @param string $label
     * @return MenuItem
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set destination
     *
     * @param string $destination
     * @return MenuItem
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return string 
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     * @return MenuItem
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
