<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Team[] findAll()
 */
class TeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Team::class);
    }

    /**
     * Returns an array containing all team entrys.
     */
    public function findAll(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
SELECT id, first_name, last_name, email, department, role, photo, description FROM team
            ORDER BY first_name ASC
            ';
        $stmt = $conn->prepare($sql);
        $stmt->executeQuery();

        return $stmt->fetchAllAssociative();
    }
}
