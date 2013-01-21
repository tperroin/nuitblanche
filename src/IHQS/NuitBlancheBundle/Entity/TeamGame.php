<?php

namespace IHQS\NuitBlancheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\TeamGameRepository")
 * @ORM\Table(name="team_game")
 */
class TeamGame
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $short_name;

    /**
     * @ORM\Column(type="string")
     */
    protected $icon;

    public function __construct()
    {
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getShortName() {
        return $this->short_name;
    }

    public function setShortName($short_name) {
        $this->short_name = $short_name;
    }

    public function getIcon() {
        return $this->icon;
    }

    public function setIcon($icon) {
        $this->icon = $icon;
    }

    public function __toString()
    {
        return $this->name;
    }
}