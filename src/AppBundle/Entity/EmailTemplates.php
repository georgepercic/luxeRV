<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailTemplates.
 *
 * @ORM\Table(name="email_templates")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmailTemplatesRepository")
 */
class EmailTemplates
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="event_name", type="string", nullable=false)
     */
    private $eventName;

    /**
     * @var string
     *
     * @ORM\Column(name="email_content", type="string", nullable=false)
     */
    private $emailContent;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set eventName.
     *
     * @param string $eventName
     *
     * @return EmailTemplates
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;

        return $this;
    }

    /**
     * Get eventName.
     *
     * @return string
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * Set emailContent.
     *
     * @param string $emailContent
     *
     * @return EmailTemplates
     */
    public function setEmailContent($emailContent)
    {
        $this->emailContent = $emailContent;

        return $this;
    }

    /**
     * Get emailContent.
     *
     * @return string
     */
    public function getEmailContent()
    {
        return $this->emailContent;
    }
}
