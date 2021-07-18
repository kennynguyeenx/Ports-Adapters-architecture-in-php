<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model;

/**
 * Class Book
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model
 */
class Book
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var BookIdentification
     */
    private $identification;
    /**
     * @var string
     */
    private $title;
    /**
     * @var array
     */
    private $authors;
    /**
     * @var string
     */
    private $publisher;
    /**
     * @var string
     */
    private $publishedDate;
    /**
     * @var string
     */
    private $description;
    /**
     * @var int
     */
    private $pages;
    /**
     * @var string
     */
    private $imageLink;

    /**
     * Book constructor.
     * @param BookIdentification $identification
     * @param string $title
     * @param array $authors
     * @param string $publisher
     * @param string $publishedDate
     * @param string $description
     * @param int $pages
     * @param string $imageLink
     */
    public function __construct(
        BookIdentification $identification,
        string $title,
        array $authors,
        string $publisher,
        string $publishedDate,
        string $description,
        int $pages,
        string $imageLink
    ) {
        $this->identification = $identification;
        $this->title = $title;
        $this->authors = $authors;
        $this->publisher = $publisher;
        $this->publishedDate = $publishedDate;
        $this->description = $description;
        $this->pages = $pages;
        $this->imageLink = $imageLink;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return BookIdentification
     */
    public function getIdentification(): BookIdentification
    {
        return $this->identification;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @return string
     */
    public function getPublisher(): string
    {
        return $this->publisher;
    }

    /**
     * @return string
     */
    public function getPublishedDate(): string
    {
        return $this->publishedDate;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getPages(): int
    {
        return $this->pages;
    }

    /**
     * @return string
     */
    public function getImageLink(): string
    {
        return $this->imageLink;
    }
}
