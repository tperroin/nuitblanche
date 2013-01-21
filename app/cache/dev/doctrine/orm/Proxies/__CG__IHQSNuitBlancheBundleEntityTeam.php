<?php

namespace Proxies\__CG__\IHQS\NuitBlancheBundle\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Team extends \IHQS\NuitBlancheBundle\Entity\Team implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function getName()
    {
        $this->__load();
        return parent::getName();
    }

    public function setName($name)
    {
        $this->__load();
        return parent::setName($name);
    }

    public function getIcon()
    {
        $this->__load();
        return parent::getIcon();
    }

    public function setIcon($icon)
    {
        $this->__load();
        return parent::setIcon($icon);
    }

    public function getTag()
    {
        $this->__load();
        return parent::getTag();
    }

    public function setTag($tag)
    {
        $this->__load();
        return parent::setTag($tag);
    }

    public function getTeamGame()
    {
        $this->__load();
        return parent::getTeamGame();
    }

    public function setTeamGame(\IHQS\NuitBlancheBundle\Entity\TeamGame $teamGame)
    {
        $this->__load();
        return parent::setTeamGame($teamGame);
    }

    public function getWars()
    {
        $this->__load();
        return parent::getWars();
    }

    public function getPlayers()
    {
        $this->__load();
        return parent::getPlayers();
    }

    public function addPlayer(\IHQS\NuitBlancheBundle\Entity\User $user)
    {
        $this->__load();
        return parent::addPlayer($user);
    }

    public function removePlayer(\IHQS\NuitBlancheBundle\Entity\User $user)
    {
        $this->__load();
        return parent::removePlayer($user);
    }

    public function __toString()
    {
        $this->__load();
        return parent::__toString();
    }

    public function getStats()
    {
        $this->__load();
        return parent::getStats();
    }

    public function initStatsVariables()
    {
        $this->__load();
        return parent::initStatsVariables();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'name', 'icon', 'tag', 'players', 'wars', 'teamGame');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}