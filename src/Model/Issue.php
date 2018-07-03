<?php

namespace App\Model;

use DateTime;

class Issue
{

    /** @var int */
    private $id;

    /** @var int */
    private $number;

    /** @var string */
    private $title;

    /** @var DateTime */
    private $createdAt;

    /** @var int */
    private $commentsCount;

    /** @var Comment[] */
    private $comments = [];

    /** @var User */
    private $user;

    /** @var string */
    private $body;

    /** @var string */
    private $state;

    /** @var Label[] */
    private $labels = [];

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
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getCommentsCount(): int
    {
        return $this->commentsCount;
    }

    /**
     * @param int $commentsCount
     */
    public function setCommentsCount(int $commentsCount)
    {
        $this->commentsCount = $commentsCount;
    }

    /**
     * @return Comment[]
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @param Comment[] $comments
     */
    public function setComments(array $comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body)
    {
        $this->body = $body;
    }

    /**
     * @return Label[]
     */
    public function getLabels(): array
    {
        return $this->labels;
    }

    /**
     * @param Label[] $labels
     */
    public function setLabels(array $labels)
    {
        $this->labels = $labels;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state)
    {
        $this->state = $state;
    }

    public static function createFromArray(array $input): Issue
    {
        $issue = new Issue();

        $issue->setBody($input['body']);
        $issue->setCreatedAt(new DateTime($input['created_at']));
        $issue->setId($input['id']);
        $issue->setNumber($input['number']);
        $issue->setTitle($input['title']);
        $issue->setState($input['state']);
        $issue->setCommentsCount($input['comments']);
        $issue->setUser(User::createFromArray($input['user']));

        $labels = [];
        foreach ($input['labels'] as $rawLabel) {
            $labels[] = Label::createFromArray($rawLabel);
        }
        $issue->setLabels($labels);

        return $issue;
    }

}
