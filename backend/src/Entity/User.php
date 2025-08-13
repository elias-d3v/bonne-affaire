<?php
namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`User`')]
#[UniqueEntity('email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[Assert\NotBlank, Assert\Email]
    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private string $email;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 255)]
    private string $password;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $registrationDate;

    // ENUM(Role) dans le MCD -> on le stocke comme string et on valide
    #[Assert\Choice(['ROLE_USER','ROLE_ADMIN'])]
    #[ORM\Column(type: 'string', length: 20)]
    private string $role = 'ROLE_USER';

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 45)]
    private string $ipAddress;

    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }

    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }

    public function getPassword(): string { return $this->password; }
    public function setPassword(string $password): self { $this->password = $password; return $this; }

    public function getPhone(): ?string { return $this->phone; }
    public function setPhone(?string $phone): self { $this->phone = $phone; return $this; }

    public function getRegistrationDate(): \DateTimeImmutable { return $this->registrationDate; }
    public function setRegistrationDate(\DateTimeImmutable $d): self { $this->registrationDate = $d; return $this; }

    public function getRole(): string { return $this->role; }
    public function setRole(string $role): self { $this->role = $role; return $this; }

    public function getIpAddress(): string { return $this->ipAddress; }
    public function setIpAddress(string $ip): self { $this->ipAddress = $ip; return $this; }

    // --- Implémentations Security ---
    public function getUserIdentifier(): string { return $this->email; }
    public function getRoles(): array { return [$this->role]; } // respecte l'ENUM du MCD
    public function eraseCredentials(): void {}
}
