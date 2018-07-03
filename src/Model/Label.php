<?php

namespace App\Model;

class Label
{

    /** @var string */
    private $color;

    /** @var string */
    private $name;

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color)
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public static function createFromArray(array $input): Label
    {
        $label = new Label();

        $label->setName($input['name']);
        $label->setColor($input['color']);

        return $label;
    }

}
