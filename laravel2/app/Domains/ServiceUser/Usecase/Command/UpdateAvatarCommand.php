<?php

declare(strict_types=1);

namespace App\Domains\ServiceUser\Usecase\Command;

class UpdateAvatarCommand
{
    private int $userId;
    private ?string $fileContent;
    private ?string $filename;
    private ?string $fileExtension;
    private ?string $contentType;

    /**
     * @param string $displayName
     */
    public function __construct(
        int $userId,
        ?string $fileContent,
        ?string $filename,
        ?string $fileExtension,
        ?string $contentType,
    ) {
        $this->userId = $userId;
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
     * @return string|null
     */
    public function getFileContent(): ?string
    {
        return $this->fileContent;
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @return string|null
     */
    public function getFileExtension(): ?string
    {
        return $this->fileExtension;
    }

    /**
     * @return string|null
     */
    public function getContentType(): ?string
    {
        return $this->contentType;
    }
}
