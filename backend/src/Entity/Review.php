<?php
namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $comment = null;

    #[Assert\NotNull]
    #[ORM\Column(type: 'smallint')]
    private int $rating; // 1..5 par ex.

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private User $author;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private User $reviewed;

    public function getId(): ?int { return $this->id; }
    public function getComment(): ?string { return $this->comment; }
    public function setComment(?string $c): self { $this->comment = $c; return $this; }
    public function getRating(): int { return $this->rating; }
    public function setRating(int $r): self { $this->rating = $r; return $this; }
    public function getAuthor(): User { return $this->author; }
    public function setAuthor(User $u): self { $this->author = $u; return $this; }
    public function getReviewed(): User { return $this->reviewed; }
    public function setReviewed(User $u): self { $this->reviewed = $u; return $this; }
}
