<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

/**
 * @Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @Column(name="title", type="string", length=100)
     * @var string
     */
    protected $title;

    /**
     * @Column(name="author", type="string", length=100)
     * @var string
     */
    protected $author;

    /**
     * @Column(name="isbn", type="string", length=20)
     * @var string
     */
    protected $isbn;

    /**
     * @Column(name="abstract", type="string", length=255)
     * @var string
     */
    protected $abstract;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     * @return Book
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
        return $this;
    }

    /**
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * @param string $abstract
     * @return Book
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

}