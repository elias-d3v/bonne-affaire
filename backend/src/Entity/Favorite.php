<?php
namespace App\Entity;

use App\Repository\FavoriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavoriteRepository::class)]
#[ORM\Table(name: 'Favorite')]
#[ORM\UniqueConstraint(name: 'uniq_fav_user_post', columns: ['user_id','post_id'])]
class Favorite
{
    // Composite PK : Doctrine supporte en marquant les 2 FK comme @Id
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private User $user;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Post::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Post $post;

    public function getUser(): User { return $this->user; }
    public function setUser(User $u): self { $this->user = $u; return $this; }

    public function getPost(): Post { return $this->post; }
    public function setPost(Post $p): self { $this->post = $p; return $this; }
}
