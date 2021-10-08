<?php

namespace App\Models;

class Task
{
    private string $id;
    private string $date;
    private string $title;
    private string $status;

    public const STATUS_CREATED = 'created';
    public const STATUS_DONE = 'done';

    private const STATUSES = [self::STATUS_CREATED, self::STATUS_DONE];

    public function __construct(string $id, string $date, string $title, ?string $status = null)
    {
        $this->title = $title;
        $this->date = $date;
        $this->id = $id;
        $this->setStatus($status ?? Task::STATUS_CREATED);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        if (!in_array($status, self::STATUSES)) {
            return;
        }

        $this->status = $status;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'date' => $this->getDate(),
            'title' => $this->getTitle(),
            'status' => $this->getStatus(),
        ];
    }

}