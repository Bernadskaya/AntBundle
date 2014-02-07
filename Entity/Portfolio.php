<?php
/**
 * Created by PhpStorm.
 * User: nevada
 * Date: 08.01.14
 * Time: 19:18
 */

namespace Ant\Bundle\Entity;


class Portfolio {
    /**
     * @var integer
     *
     */
    private $id;

    /**
     * @var string
     *
     */
    private $title;

    /**
     * @var string
     *
     */
    private $description;

    /**
     * @var string
     *
     */
    private $metaKey;

    /**
     * @var string
     *
     */
    private $metaDesc;

    /**
     * @var string
     *
     */
    private $position;


    /**
     *
     */
    private $portfolioItem;

    /**
     * @var \DateTime
     *
     */
    private $created;


    /**
     *
     */
    private $slug;

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
     * Set description
     *
     * @param string $description
     * @return Portfolio
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set metakey
     *
     * @param string $metaKey
     * @return Portfolio
     */
    public function setMetaKey($metaKey)
    {
        $this->metaKey = $metaKey;

        return $this;
    }

    /**
     * Get metakey
     *
     * @return string
     */
    public function getMetaKey()
    {
        return $this->metaKey;
    }

    /**
     * Set metaDesc
     *
     * @param string $metaDesc
     * @return Portfolio
     */
    public function setMetaDesc($metaDesc)
    {
        $this->metaDesc = $metaDesc;

        return $this;
    }

    /**
     * Get metaDesc
     *
     * @return string
     */
    public function getMetaDesc()
    {
        return $this->metaDesc;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Portfolio
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }


    /**
     * Get position
     *
     * @return Portfolio
     */
    public function getPortfolioItem()
    {
        return $this->portfolioItem;
    }


    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
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

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->portfolioItem = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Portfolio
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Portfolio
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Add portfolioItem
     *
     * @param \Ant\Bundle\Entity\PortfolioItem $portfolioItem
     *
     * @return Portfolio
     */
    public function addPortfolioItem(\Ant\Bundle\Entity\PortfolioItem $portfolioItem)
    {
        $this->portfolioItem[] = $portfolioItem;

        return $this;
    }

    /**
     * Remove portfolioItem
     *
     * @param \Ant\Bundle\Entity\PortfolioItem $portfolioItem
     */
    public function removePortfolioItem(\Ant\Bundle\Entity\PortfolioItem $portfolioItem)
    {
        $this->portfolioItem->removeElement($portfolioItem);
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $images;


    /**
     * Add images
     *
     * @param \Ant\Bundle\Entity\Image $images
     *
     * @return Portfolio
     */
    public function addImage(\Ant\Bundle\Entity\Image $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \Ant\Bundle\Entity\Image $images
     */
    public function removeImage(\Ant\Bundle\Entity\Image $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }
}
