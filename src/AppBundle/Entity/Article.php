<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\ Entity
* @ORM\ Table
*/
Class Article
{
  /**
  * @ORM\Column(name="article_id", type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  */
  private $id;
  /**
  * @ORM\ Column(type="string",length=255)
  */
  private $title;

  /**
  * @ORM\ Column(type="string",length=255)
  */
  private $header_image;

  /**
  * @ORM\ Column(type="string",length=255)
  */
  private $author;

  /**
  * @ORM\Column(type="datetime")
  */
  private $createdAt;

  /**
  * @ORM\Column(type="text")
  */
  private $content;
  public function __construct()
  {
    $this->createdAt = new \DateTime();
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
     * Set title
     *
     * @param string $title
     *
     * @return Article
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
     * Set headerImage
     *
     * @param string $headerImage
     *
     * @return Article
     */
    public function setHeaderImage($headerImage)
    {
        $this->header_image = $headerImage;

        return $this;
    }

    /**
     * Get headerImage
     *
     * @return string
     */
    public function getHeaderImage()
    {
        return $this->header_image;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Article
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Article
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
