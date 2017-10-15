<?php

// /src/AppBundle/Repository/ArticleRepository.php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    public function queryBuilder()
    {
        return $this->_em->getRepository('AppBundle:Article')->createQueryBuilder('a');
    }
}
