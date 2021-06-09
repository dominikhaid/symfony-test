<?php

namespace App\Repository;

use App\Entity\Posts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Posts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Posts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Posts[]    findAll()
 * @method Posts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Posts::class);
    }

    /**
     * Returns an array containing all blog post entrys.
     */
    public function findAll(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
SELECT * FROM posts_view
            ORDER BY updated_at ASC
            ';
        $stmt = $conn->prepare($sql);
        $stmt->executeQuery();

        return $stmt->fetchAllAssociative();
    }
}
