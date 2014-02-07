<?php

namespace Ant\Bundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Yaml\Yaml;

/**
 * Image
 */
class Image
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set path
     *
     * @param string $path
     *
     * @return Image
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Image
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
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
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Image
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

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
     * @var \Ant\Bundle\Entity\News
     */
    private $news;


    /**
     * Set news
     *
     * @param \Ant\Bundle\Entity\News $news
     *
     * @return Image
     */
    public function setNews(\Ant\Bundle\Entity\News $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \Ant\Bundle\Entity\News
     */
    public function getNews()
    {
        return $this->news;
    }
    /**
     * @var \Ant\Bundle\Entity\Ad
     */
    private $ad;


    /**
     * Set ad
     *
     * @param \Ant\Bundle\Entity\Ad $ad
     *
     * @return Image
     */
    public function setAd(\Ant\Bundle\Entity\Ad $ad = null)
    {
        $this->ad = $ad;

        return $this;
    }

    /**
     * Get ad
     *
     * @return \Ant\Bundle\Entity\Ad
     */
    public function getAd()
    {
        return $this->ad;
    }
    /**
     * @var \Ant\Bundle\Entity\Portfolio
     */
    private $portfolio;


    /**
     * Set portfolio
     *
     * @param \Ant\Bundle\Entity\Portfolio $portfolio
     *
     * @return Image
     */
    public function setPortfolio(\Ant\Bundle\Entity\Portfolio $portfolio = null)
    {
        $this->portfolio = $portfolio;

        return $this;
    }

    /**
     * Get portfolio
     *
     * @return \Ant\Bundle\Entity\Portfolio
     */
    public function getPortfolio()
    {
        return $this->portfolio;
    }



    protected $uploadFile;
    protected $uploadDir;

    public function getUploadFile()
    {
        return $this->uploadFile;
    }

    public function setUploadFile(UploadedFile $file)
    {
        $this->uploadFile = $file;
    }

    public function preUpload()
    {
        if ($this->uploadFile) {
            $this->path = sha1(uniqid()).'.'.$this->uploadFile->guessExtension();
        }
    }

    public function upload()
    {
        if ($this->uploadFile) {
            $this->uploadFile->move($this->getUploadRootDir(), $this->path);
            unset($this->uploadFile);
        }
    }

    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    public function getAbsolutePath()
    {
        return empty($this->path) ? null : $this->getUploadRootDir().DIRECTORY_SEPARATOR.$this->path;
    }

    public function getWebPath()
    {
        return empty($this->path) ? null : $this->getUploadDir().DIRECTORY_SEPARATOR.$this->path;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../../../web'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        if (!$this->uploadDir) {
            $config = Yaml::parse(__DIR__.'/../../../../../../app/config/config.yml');
            $this->uploadDir = isset($config['ant']['upload_dir']) ? $config['ant']['upload_dir'] : '/uploads';
        }
        return $this->uploadDir;
    }
}
