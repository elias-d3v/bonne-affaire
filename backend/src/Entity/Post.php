<?php
namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'text')]
    private string $description;

    #[Assert\NotNull]
    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private string $price;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $publishedAt;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 50)]
    private string $condition;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 255)]
    private string $location;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private User $user;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Category $category;

    public function getId(): ?int { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $v): self { $this->title = $v; return $this; }
    public function getDescription(): string { return $this->description; }
    public function setDescription(string $v): self { $this->description = $v; return $this; }
    public function getPrice(): string { return $this->price; }
    public function setPrice(string $v): self { $this->price = $v; return $this; }
    public function getPublishedAt(): \DateTimeInterface { return $this->publishedAt; }
    public function setPublishedAt(\DateTimeInterface $d): self { $this->publishedAt = $d; return $this; }
    public function getCondition(): string { return $this->condition; }
    public function setCondition(string $v): self { $this->condition = $v; return $this; }
    public function getLocation(): string { return $this->location; }
    public function setLocation(string $v): self { $this->location = $v; return $this; }
    public function getUser(): User { return $this->user; }
    public function setUser(User $u): self { $this->user = $u; return $this; }
    public function getCategory(): Category { return $this->category; }
    public function setCategory(Category $c): self { $this->category = $c; return $this; }
}
