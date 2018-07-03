<?php

namespace App\Model;

use DateTime;

class Comment
{

    /** @var int */
    private $id;

    /** @var User */
    private $user;

    /** @var DateTime */
    private $createdAt;

    /** @var string */
    private $body;

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

    public static function createFromArray(array $input): Comment
    {
        $comment = new Comment();

        $comment->setId($input['id']);
        $comment->setBody($input['body']);
        $comment->setCreatedAt(new DateTime($input['created_at']));
        $comment->setUser(User::createFromArray($input['user']));

        return $comment;
    }

}
