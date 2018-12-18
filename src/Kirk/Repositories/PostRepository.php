<?php
namespace Kirk\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class PostRepository extends EntityRepository
{
    public function __construct($entityManager)
    {
        $entityMetaData = $entityManager->getClassMetadata('Kirk\Entities\Post');
        parent::__construct($entityManager, $entityMetaData);
    }

    public function getPostById($postId)
    {
        return $this->createQueryBuilder('P')
            ->where('P.id = :postId')->setParameter('postId', (int)$postId)
            ->getQuery()
            ->execute(null,Query::HYDRATE_ARRAY);
    }

    public function getAllPostsByUserId($userid, $number = 20)
    {
        $post_table = 'kk_post';
        $post_tag_table = 'kk_post_tag';
        $tag_table = 'kk_tag';
        
        $sql = "SELECT P.*, GROUP_CONCAT(T.name SEPARATOR ',') AS all_tags
                FROM kk_post P
                LEFT JOIN kk_post_tag PT
                    ON P.id = PT.post_id
                LEFT JOIN kk_tag T
                    ON T.id = PT.tag_id
                WHERE P.user_id = $userid
                GROUP BY P.id
                ORDER BY P.date_updated DESC";

        $stmt = $this->getEntityManager()
            ->getConnection()
            ->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getRecentPosts($number = 20)
    {
        $sdl = $this->createQueryBuilder('P')
            ->select('P AS post')
            ->addSelect('U.displayname AS displayname')
            ->join('Kirk\Entities\User', 'U')
            ->where('U.id = P.user')
            ->orderBy('P.date_added', 'DESC')
            ->getQuery();

        return $sdl->execute(null,Query::HYDRATE_ARRAY);
    }
}
