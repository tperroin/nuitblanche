<?php

namespace IHQS\NuitBlancheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\WoWProfileRepository")
 * @ORM\Table(name="profile_wow")
 */
class WoWProfile
{
    const CLASS_DEATHKNIGHT  = "deathknight";
    const CLASS_DROOD        = "druid";
    const CLASS_HUNTER       = "hunter";
    const CLASS_MAGE         = "mage";
    const CLASS_PALADIN      = "paladin";
    const CLASS_PRIEST       = "priest";
    const CLASS_ROGUE        = "rogue";
    const CLASS_SHAMAN       = "shaman";
    const CLASS_WARLOCK      = "warlock";
    const CLASS_WARRIOR      = "warrior";

    static public $_classes = array(
        self::CLASS_DEATHKNIGHT	=> self::CLASS_DEATHKNIGHT,
        self::CLASS_DROOD	=> self::CLASS_DROOD,
        self::CLASS_HUNTER	=> self::CLASS_HUNTER,
        self::CLASS_MAGE        => self::CLASS_MAGE,
        self::CLASS_PALADIN	=> self::CLASS_PALADIN,
        self::CLASS_PRIEST	=> self::CLASS_PRIEST,
        self::CLASS_ROGUE	=> self::CLASS_ROGUE,
        self::CLASS_SHAMAN	=> self::CLASS_SHAMAN,
        self::CLASS_WARLOCK	=> self::CLASS_WARLOCK,
        self::CLASS_WARRIOR	=> self::CLASS_WARRIOR,
    );

    const RACE_DRAENEI  = "draenei";
    const RACE_DWARF    = "dwarf";
    const RACE_GNOME    = "gnome";
    const RACE_HUMAN    = "human";
    const RACE_NIGHTELF = "nightelf";
    const RACE_WORGEN   = "worgen";
    const RACE_BLOODELF = "bloodelf";
    const RACE_GOBLIN   = "goblin";
    const RACE_ORC      = "orc";
    const RACE_TAUREN   = "tauren";
    const RACE_TROLL    = "troll";
    const RACE_UNDEAD   = "undead";

    static public $_races = array(
        self::RACE_DRAENEI  => self::RACE_DRAENEI,
        self::RACE_DWARF    => self::RACE_DWARF,
        self::RACE_GNOME    => self::RACE_GNOME,
        self::RACE_HUMAN    => self::RACE_HUMAN,
        self::RACE_NIGHTELF => self::RACE_NIGHTELF,
        self::RACE_WORGEN   => self::RACE_WORGEN,
        self::RACE_BLOODELF => self::RACE_BLOODELF,
        self::RACE_GOBLIN   => self::RACE_GOBLIN,
        self::RACE_ORC      => self::RACE_ORC,
        self::RACE_TAUREN   => self::RACE_TAUREN ,
        self::RACE_TROLL    => self::RACE_TROLL,
        self::RACE_UNDEAD   => self::RACE_UNDEAD,
    );
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="wow", cascade={"persist"})
     * @Assert\Valid()
     */
    protected $user;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     * @Assert\Choice(callback = "getWoWClasses")
     */
    protected $class;

    /**
     * @ORM\Column(type="string")
     * @Assert\Choice(callback = "getWoWRaces")
     */
    protected $race;

    /**
     * @ORM\Column(type="string")
     * @Assert\Choice(callback = "getSexes")
     */
    protected $sex;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $role;

    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser(User $user) {
        $this->user = $user;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getClass() {
        return $this->class;
    }

    public function setClass($class) {
        if(!in_array($class, WoWProfile::$_classes))
        {
            throw new \InvalidArgumentException('Invalid parameter "' . $class . '" for WoW class');
        }
        $this->class = $class;
    }

    public function getRace() {
        return $this->race;
    }

    public function setRace($race) {
        if(!in_array($race, WoWProfile::$_races))
        {
            throw new \InvalidArgumentException('Invalid parameter "' . $race . '" for WoW race');
        }
        $this->race = $race;
    }

    public function getSex() {
        return $this->sex;
    }

    public function setSex($sex) {
        $this->sex = $sex;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }
}
