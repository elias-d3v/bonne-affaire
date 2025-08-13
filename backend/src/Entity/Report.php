<?php
namespace App\Entity;

use App\Repository\ReportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReportRepository::class)]
class Report
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private ?int $id = null;

    // auteur de l’annonce (selon ton MCD)
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private User $author;

    // utilisateur qui signale
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private User $reporter;

    #[ORM\ManyToOne(targetEntity: Post::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Post $post;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $isHandled = false;

    public function getId(): ?int { return $this->id; }
    public function getAuthor(): User { return $this->author; }
    public function setAuthor(User $u): self { $this->author = $u; return $this; }
    public function getReporter(): User { return $this->reporter; }
    public function setReporter(User $u): self { $this->reporter = $u; return $this; }
    public function getPost(): Post { return $this->post; }
    public function setPost(Post $p): self { $this->post = $p; return $this; }
    public function isHandled(): bool { return $this->isHandled; }
    public function setIsHandled(bool $v): self { $this->isHandled = $v; return $this; }
}