<?php

namespace App\Repository;

use App\Entity\Gender;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findSleevesByGender(Gender $gender)
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.category', 'c')
            ->andWhere('c.name = :category_name')
            ->andWhere('p.gender = :gender')
            ->setParameters([
                'category_name' => 'Manches',
                'gender' => $gender,
            ])
            ->getQuery()
            ->getResult();
    }
    
    public function findProductWithRelations(int $productId): ?Product
    {
        $qb = $this->createQueryBuilder('p') // Ici, 'p' est un alias pour 'Product'
            ->leftJoin('p.gender', 'g')
            ->leftJoin('p.category', 'c')
            ->leftJoin('p.productImages', 'i')
            ->leftJoin('p.sizes', 's')
            ->leftJoin('p.colors', 'co')
            ->addSelect('g', 'c', 'i', 's', 'co') // On sélectionne aussi les entités liées pour les charger en une seule requête
            ->where('p.id = :id')
            ->setParameter('id', $productId);

        return $qb->getQuery()->getOneOrNullResult();
    }

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
