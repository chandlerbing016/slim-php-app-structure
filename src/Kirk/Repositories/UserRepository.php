<?php
namespace Kirk\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class UserRepository extends EntityRepository
{
    public function __construct($entityManager)
    {
        $entityMetaData = $entityManager->getClassMetadata('Kirk\Entities\User');
        parent::__construct($entityManager, $entityMetaData);
    }

    public function getUserById($userId)
    {
        return $this->createQueryBuilder('U')
            ->where('U.id = :userId')->setParameter('userId', (int) $userId)
            ->getQuery()
            ->execute(null,Query::HYDRATE_ARRAY);
    }

    public function getUserByUsername($userName)
    {
        return $this->createQueryBuilder('U')
            ->where('U.displayname = :userName')->setParameter('userName', (string) $userName)
            ->getQuery()
            ->getOneOrNullResult(Query::HYDRATE_ARRAY);
    }
}
