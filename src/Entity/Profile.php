<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class Profile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'profile', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $location = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $birthdate = null;

    #[ORM\Column(length: 255)]
    private ?string $status = 'Undecided';

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $bio = null;

    /**
     * @var Collection<int, Interests>
     */
    #[ORM\ManyToMany(targetEntity: Interests::class, inversedBy: 'profiles')]
    private Collection $interests;

    public function __construct()
    {
        $this->interests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getAge(): ?string
    {
        $diff = $this->birthdate->diff(new \DateTimeImmutable());

        return $diff->format('y');
    }

    public function getBirthdate(): ?\DateTimeImmutable
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeImmutable $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * @return Collection<int, Interests>
     */
    public function getInterests(): Collection
    {
        return $this->interests;
    }

    public function addInterest(Interests $interest): static
    {
        if (!$this->interests->contains($interest)) {
            $this->interests->add($interest);
        }

        return $this;
    }

    public function removeInterest(Interests $interest): static
    {
        $this->interests->removeElement($interest);

        return $this;
    }
}
