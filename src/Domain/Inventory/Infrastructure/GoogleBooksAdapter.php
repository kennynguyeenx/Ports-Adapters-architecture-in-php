<?php

declare(strict_types=1);

namespace Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Infrastructure;

use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Author;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Book;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\BookIdentification;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Isbn10;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Model\Isbn13;
use Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Core\Ports\Outgoing\GetBookDetails;

/**
 * Class GoogleBooksAdapter
 * @package Kennynguyeenx\LibraryHexagonal\Domain\Inventory\Infrastructure
 */
class GoogleBooksAdapter implements GetBookDetails
{
    /**
     * @param string $googleBookId
     * @return Book
     */
    public function handle(string $googleBookId): Book
    {
        // Call  "https://www.googleapis.com/books/v1/volumes/" + googleBookId,
        $response = [];
        $volumeInfo = $response["volumeInfo"];
        $isbn10 = new Isbn10($this->extractIsbn($volumeInfo, "ISBN_10"));
        $isbn13 = new Isbn13($this->extractIsbn($volumeInfo, "ISBN_13"));

        return new Book(
            new BookIdentification($googleBookId, $isbn10, $isbn13),
            (string) $volumeInfo['title'],
            $this->extractAuthors($volumeInfo),
            (string) $volumeInfo["publisher"],
            (string) $volumeInfo["publishedDate"],
            (string) $volumeInfo["description"],
            (int) $volumeInfo["pageCount"],
            $this->extractImage($volumeInfo)
        );
    }

    /**
     * @param $volumeInfo
     * @param string $isbnType
     * @return string
     */
    private function extractIsbn($volumeInfo, string $isbnType): string
    {
        //return StreamSupport.stream(
        //                ofNullable(volumeInfo)
        //                        .map(volume -> volume.getAsJsonArray("industryIdentifiers"))
        //                        .orElseThrow(() -> new RuntimeException(""))
        //                        .spliterator(),
        //                false)
        //                .map(JsonElement::getAsJsonObject)
        //                .filter(isbnObject -> isbnObject.getAsJsonPrimitive("type").getAsString().equals(isbnType))
        //                .map(isbnObject -> isbnObject.getAsJsonPrimitive("identifier").getAsString())
        //                .findFirst()
        //                .orElseThrow(() -> new RuntimeException("Inside volumeInfo there is no " + isbnType));
        return '';
    }

    /**
     * @param $volumeInfo
     * @return Author[]
     */
    private function extractAuthors($volumeInfo): array
    {
        //return StreamSupport.stream(
        //                ofNullable(volumeInfo)
        //                        .map(volume -> volume.getAsJsonArray("authors"))
        //                        .orElseThrow(() -> new RuntimeException(""))
        //                        .spliterator(),
        //                false)
        //                .map(JsonElement::getAsString)
        //                .map(Author::new)
        //                .collect(Collectors.toSet());
        return [new Author('')] ;
    }

    /**
     * @param $volumeInfo
     * @return string
     */
    private function extractImage($volumeInfo): string
    {
        //Set<Map.Entry<String, JsonElement>> imageLinksSet = volumeInfo.getAsJsonObject("imageLinks").entrySet();
        //
        //        if (isImageThumbnailLinkInResponse(imageLinksSet)){
        //            return StreamSupport.stream(
        //                    imageLinksSet.spliterator(), false)
        //                    .filter(imageEntry -> imageEntry.getKey().equals("thumbnail"))
        //                    .findFirst()
        //                    .orElseThrow()
        //                    .getValue()
        //                    .getAsString();
        //        } else {
        //            return StreamSupport.stream(
        //                    imageLinksSet.spliterator(), false)
        //                    .map(entry -> entry.getValue().getAsString())
        //                    .findAny()
        //                    .orElse("");
        //        }
        return '';
    }

    /**
     * @param array $imageLinksSet
     * @return bool
     */
    private function isImageThumbnailLinkInResponse(array $imageLinksSet): bool
    {
        //return StreamSupport.stream(
        //                        imageLinksSet.spliterator(), false)
        //                    .filter(entry -> entry.getKey().equals("thumbnail"))
        //                    .findFirst()
        //                    .isEmpty();
        return true;
    }
}
