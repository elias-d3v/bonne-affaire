<?php
namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'text')]
    private string $content;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $sentAt;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private User $sender;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private User $receiver;

    public function getId(): ?int { return $this->id; }
    public function getContent(): string { return $this->content; }
    public function setContent(string $c): self { $this->content = $c; return $this; }
    public function getSentAt(): \DateTimeInterface { return $this->sentAt; }
    public function setSentAt(\DateTimeInterface $d): self { $this->sentAt = $d; return $this; }
    public function getSender(): User { return $this->sender; }
    public function setSender(User $u): self { $this->sender = $u; return $this; }
    public function getReceiver(): User { return $this->receiver; }
    public function setReceiver(User $u): self { $this->receiver = $u; return $this; }
}
