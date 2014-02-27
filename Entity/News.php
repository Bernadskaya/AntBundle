<?php

namespace Ant\Bundle\Entity;

use Sonata\CoreBundle\Model\BaseEntityManager;
use Gedmo;
/**
 * News
 */
class News
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $text;

//    /**
//     * @var \DateTime $createdAt
//     *
//     */
//    private $createdAt;
//
//    /**
//     * @var \DateTime $updatedAt
//     *
//     *
//     */
//    private $updatedAt;


    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media $media
     */
    private $media;

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
     * Set text
     *
     * @param string $text
     *
     * @return News
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }


    /**
     * Set media
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $media
     *
     * @return News
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }



///*
//    /**
//     * Set createdAt
//     *
//     * @param \DateTime $createdAt
//     *
//     * @return News
//     */
//    public function setCreatedAt($createdAt)
//    {
//        $this->createdAt = $createdAt;
//
//        return $this;
//    }
//
//    /**
//     * Get createdAt
//     *
//     * @return \DateTime
//     */
//    public function getCreatedAt()
//    {
//        return $this->createdAt;
//    }
//
//    /**
//     * Set updatedAt
//     *
//     * @param \DateTime $updatedAt
//     *
//     * @return News
//     */
//    public function setUpdatedAt($updatedAt)
//    {
//        $this->updatedAt = $updatedAt;
//
//        return $this;
//    }
//
//    /**
//     * Get updatedAt
//     *
//     * @return \DateTime
//     */
//    public function getUpdatedAt()
//    {
//        return $this->updatedAt;
//    }
//
//
//
//    /**
//     * {@inheritdoc}
//     */
//    public function prePersist()
//    {
//
//
//        // fix weird bug with setter object not being call
//        $this->setMedia($this->getMedia());
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function preUpdate()
//    {
//        // fix weird bug with setter object not being call
//        $this->setMedia($this->getMedia());
//    }
}

