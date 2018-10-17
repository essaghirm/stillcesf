<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank(message="Description should not be blank")
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Date should not be blank")
     */
    private $date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ord;

    /**
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     * @Assert\NotNull(message="Project should not be null")
     */
    private $project;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="creator", referencedColumnName="id")
     * @Assert\NotNull(message="Creator should not be null")
     */
    private $creator;

    /**
     * @ORM\ManyToOne(targetEntity="user")
     * @ORM\JoinColumn(name="attached_to", referencedColumnName="id")
     * @Assert\NotNull(message="AttachedTo should not be null")
     */
    private $attachedTo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getOrd(): ?int
    {
        return $this->ord;
    }

    public function setOrd(?int $ord): self
    {
        $this->ord = $ord;

        return $this;
    }

    public function getProject(): ?project
    {
        return $this->project;
    }

    public function setProject(?project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getCreator(): ?user
    {
        return $this->creator;
    }

    public function setCreator(?user $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    public function getAttachedTo(): ?user
    {
        return $this->attachedTo;
    }

    public function setAttachedTo(?user $attachedTo): self
    {
        $this->attachedTo = $attachedTo;

        return $this;
    }
}
