<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="first_name", type="string", length=64,  nullable=false, options={"default": ""})
     */
    private $firstName;

    /**
     * @ORM\Column(name="last_name", type="string", length=64, nullable=false, options={"default": ""})
     */
    private $lastName;
    /**
     * @ORM\Column(name="email", type="string", length=100, nullable=false, options={"default": ""})
     */
    private $email;

    /**
     * @ORM\Column(name="department", type="string", length=100, nullable=false, options={"default": ""})
     */
    private $department;

    /**
     * @ORM\Column(name="role", type="smallint",  nullable=false, options={"default": 0})
     */
    private $role;

    /**
     * @ORM\Column(name="photo", type="string", length=150, nullable=false, options={"default": ""})
     */
    private $photo;

    /**
     * @ORM\Column(name="description", type="text", nullable=false, options={"default": ""})
     */
    private $description;
    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default": "CURRENT_TIMESTAMP"})
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true, options={"default": "CURRENT_TIMESTAMP"})
     */
    protected $updatedAt;

    public function updatedTimestamps(): void
    {
        $dateTimeNow = new DateTime('now');

        $this->setUpdatedAt($dateTimeNow);

        if (null === $this->getCreatedAt()) {
            $this->setCreatedAt($dateTimeNow);
        }
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): self
    {
        $this->department = $department;

        return $this;
    }
}
