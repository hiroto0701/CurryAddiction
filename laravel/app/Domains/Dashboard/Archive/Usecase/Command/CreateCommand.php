<?php

declare(strict_types=1);

namespace App\Domains\Post\Usecase\Command;

class CreateCommand
{
    private int $userId;
    private int $genreId;
    private int $regionId;
    private int $prefectureId;
    private string $storeName;
    private ?string $comment;
    private float $latitude;
    private float $longitude;
    private string $fileContent;
    private string $filename;
    private string $fileExtension;
    private string $contentType;

    public function __construct(
        int $userId,
        int $genreId,
        int $regionId,
        int $prefectureId,
        string $storeName,
        ?string $comment,
        float $latitude,
        float $longitude,
        string $fileContent,
        string $filename,
        string $fileExtension,
        string $contentType,
    ) {
        $this->userId = $userId;
        $this->genreId = $genreId;
        $this->regionId = $regionId;
        $this->prefectureId = $prefectureId;
        $this->storeName = $storeName;
        $this->comment = $comment;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->fileContent = $fileContent;
        $this->filename = $filename;
        $this->fileExtension = $fileExtension;
        $this->contentType = $contentType;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getGenreId(): int
    {
        return $this->genreId;
    }

    /**
     * @return int
     */
    public function getRegionId(): int
    {
        return $this->regionId;
    }

    /**
     * @return int
     */
    public function getPrefectureId(): int
    {
        return $this->prefectureId;
    }

    /**
     * @return string
     */
    public function getStoreName(): string
    {
        return $this->storeName;
    }

    /**
     * @return string | null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }
    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }


    /**
     * @return string
     */
    public function getFileContent(): string
    {
        return $this->fileContent;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getFileExtension(): string
    {
        return $this->fileExtension;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

}
