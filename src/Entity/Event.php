<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 96)]
    private $name;

    #[ORM\Column(type: 'datetime')]
    private $startDate;

    #[ORM\Column(type: 'integer')]
    private $durationMinute;

    #[ORM\Column(type: 'string', length: 32)]
    private $language;

    #[ORM\Column(type: 'integer')]
    private $requiredUser;

    #[ORM\Column(type: 'string', length: 96)]
    private $customer;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Registration::class, orphanRemoval: true,fetch:"EAGER")]
    private $registrations;

    #[ORM\ManyToOne(targetEntity: Activity::class, inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private $activity;

    #[ORM\Column(type: 'string', length: 256, nullable: true)]
    private $address;

    public function __construct()
    {
        $this->registrations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getDurationMinute(): ?int
    {
        return $this->durationMinute;
    }

    public function setDurationMinute(int $durationMinute): self
    {
        $this->durationMinute = $durationMinute;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getRequiredUser(): ?int
    {
        return $this->requiredUser;
    }

    public function setRequiredUser(int $requiredUser): self
    {
        $this->requiredUser = $requiredUser;

        return $this;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function setCustomer(string $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection<int, Registration>
     */
    public function getRegistrations(): Collection
    {
        return $this->registrations;
    }

    public function addRegistration(Registration $registration): self
    {
        if (!$this->registrations->contains($registration)) {
            $this->registrations[] = $registration;
            $registration->setEvent($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): self
    {
        if ($this->registrations->removeElement($registration)) {
            // set the owning side to null (unless already changed)
            if ($registration->getEvent() === $this) {
                $registration->setEvent(null);
            }
        }

        return $this;
    }

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

}
