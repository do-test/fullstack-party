<?php

namespace App\Model;

class User
{

    /** @var int */
    private $id;

    /** @var string */
    private $login;

    /** @var string */
    private $avatarUrl;

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
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }

    /**
     * @param string $avatarUrl
     */
    public function setAvatarUrl(string $avatarUrl)
    {
        $this->avatarUrl = $avatarUrl;
    }

    public static function createFromArray(array $input): User
    {
        $user = new User();

        $user->setId($input['id']);
        $user->setLogin($input['login']);
        $user->setAvatarUrl($input['avatar_url']);

        return $user;
    }

}
