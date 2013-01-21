<?php

namespace IHQS\NuitBlancheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use IHQS\NuitBlancheBundle\Validator\Unique;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use IHQS\TournamentBundle\Model\PlayerInterface;

/**
 * @ORM\Entity(repositoryClass="IHQS\NuitBlancheBundle\Model\UserRepository")
 * @ORM\Table(name="nb_user")
 * @ORM\HasLifecycleCallbacks
 */
class User implements PlayerInterface, \Serializable
{
    const STATUS_ONLINE     = "online";
    const STATUS_OFFLINE    = "offline";
    const STATUS_IDLE       = "idle";

    static public $_sexes = array(
        'female'    => 'female',
        'male'      => 'male',
    );

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Unique(message = "This username is already used. Please choose another one.")
     * @Assert\NotBlank(groups="Registration", message = "Please choose a username")
     * @Assert\MinLength(4)
     */
    protected $username;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(groups="Password", message = "Please choose a password")
     * @Assert\MinLength(8)
     */
    protected $password;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(groups="Registration", message = "Please add your email adress")
     * @Assert\Email()
     */
    protected $email;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\File()
     */
    protected $avatar;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(groups="Registration", message = "Please add your first name")
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(groups="Registration", message = "Please add your last name")
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $city;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(groups="Registration", message = "Please choose your country")
     */
    protected $country;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Url()
     */
    protected $facebook;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $twitter;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $skype;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Email()
     */
    protected $msn;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $roles;

    /**
     * @ORM\OneToMany(targetEntity="News", mappedBy="author")
     */
    protected $news;

    /**
     * @ORM\OneToMany(targetEntity="Replay", mappedBy="uploader")
     */
    protected $uploadedReplays;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $lastActivity;

    /**
     * @ORM\OneToOne(targetEntity="SC2Profile", mappedBy="user", cascade={"persist"})
     */
    protected $sc2;

    /**
     * @ORM\OneToOne(targetEntity="WoWProfile", mappedBy="user", cascade={"persist"})
     */
    protected $wow;

    public function serialize() {
        return serialize(array(
            $this->username,
            $this->password
        ));
    }

    public function unserialize($data) {
        list($username, $password) = unserialize($data);
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist() {
        if($this->sc2 instanceof SC2Profile && !$this->sc2->getSc2Account())
		{
			$this->sc2 = null;
		}
        if($this->wow instanceof WoWProfile && !$this->wow->getName())
		{
			$this->wow = null;
		}
    }

	public function __construct()
	{
		$this->roles = serialize(array('ROLE_USER'));
	}

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getAvatar() {
        if(!is_null($this->avatar))
        {
            $rootDir = __DIR__.'/../../../../web';
            return new File($rootDir . $this->avatar);
        }
    }

    public function getAvatarUrl() {
        return $this->avatar ?: '/bundles/ihqsnuitblanche/images/avatar/default.gif';
    }

    public function getAvatarMargin() {
        if(is_null($this->avatar)) { return 0; }

        $rootDir = __DIR__.'/../../../../web';
        list($width, $height) = getimagesize($rootDir . $this->avatar);

        if($width <= $height) { return 0; }

        $resizedWidth = $width * 100 / $height;
        return floor(($resizedWidth - 100) / 2);
    }

    public function setAvatar($avatar) {
        if(is_object($avatar) && $avatar instanceof UploadedFile)
        {
            @chmod($avatar->getPath(), 0777);

            $dir = '/upload/avatar';
            $filename = strtolower($this->username) . '.' . pathinfo($avatar->getClientOriginalName(), PATHINFO_EXTENSION);

            $rootDir = __DIR__.'/../../../../web';
            $avatar->move($rootDir . $dir, $filename);
            $this->avatar = $dir . '/' . $filename;
        }
    }
    
    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getCountry() {
        return $this->country;
    }
    
    public function getCountryCode() {
        return strtoupper(substr($this->getCountry(), 0, 2));
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getFacebook() {
        return $this->facebook;
    }

    public function setFacebook($facebook) {
        $this->facebook = $facebook;
    }

    public function getTwitter() {
        return $this->twitter;
    }

    public function setTwitter($twitter) {
        $this->twitter = $twitter;
    }

    public function getSkype() {
        return $this->skype;
    }

    public function setSkype($skype) {
        $this->skype = $skype;
    }

    public function getMsn() {
        return $this->msn;
    }

    public function setMsn($msn) {
        $this->msn = $msn;
    }

    public function getLastActivity()
    {
        return $this->lastActivity;
    }

    public function setLastActivity(\DateTime $lastActivity)
    {
        $this->lastActivity = $lastActivity;
    }

	public function lastSeen()
	{
		if(!$this->getLastActivity()) { return null ; }
		return $this->getLastActivity()->diff(new \DateTime())->format('%a');
	}

    public function getStatus()
    {
        $diff = time() - $this->getLastActivity()->getTimestamp();
        if($diff < 600) { return self::STATUS_ONLINE; }
        if($diff < 900) { return self::STATUS_IDLE; }
        return self::STATUS_OFFLINE;
    }

    public function getPublicMsn() {
        if(is_null($this->msn))  { return null; }

        list($account, $tld) = explode('@', $this->msn);
        list($domain, $region) = explode('.', $tld);

        return $account . '@' . substr($domain, 0, 1) . '....' . $region;
    }

    public function getSc2()
    {
        return $this->sc2;
    }

    public function setSc2(SC2Profile $sc2)
    {
        $this->sc2 = $sc2;
    }

    public function getWow()
    {
        return $this->wow;
    }

    public function setWow(WoWProfile $wow)
    {
        $this->wow = $wow;
    }

    public function getProfiles()
    {
        $profiles = array();
        if($this->sc2 instanceof SC2Profile) { $profiles['sc2'] = "StarCraft 2"; }
        if($this->wow instanceof WoWProfile) { $profiles['wow'] = "World Of WarCraft"; }

        return $profiles;
    }

	public function addRole($role) {
		$roles = unserialize($this->roles);
		$roles[] = $role;
		$this->roles = serialize($roles);
	}

    public function getRoles() {
		$roles = unserialize($this->roles);
		if(!$roles || !is_array($roles)) { $roles = array('ROLE_USER'); }
        return $roles;
    }

    public function getSalt() {
        return '';
    }

    public function eraseCredentials() {
        return true;
    }

    public function equals(UserInterface $user) {
        return ($user->getUsername() == $this->getUsername());
    }

    static public function getSC2Races()
    {
        return array_keys(SC2Profile::$_sc2races);
    }

    static public function getWoWClasses()
    {
        return array_keys(WoWProfile::$_classes);
    }

    static public function getWoWRaces()
    {
        return array_keys(WoWProfile::$_races);
    }

    static public function getSexes()
    {
        return array_keys(User::$_sexes);
    }
}
