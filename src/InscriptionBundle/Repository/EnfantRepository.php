<?php

namespace InscriptionBundle\Repository;

/**
 * EnfantRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EnfantRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param $enfant
     * @return array|\Doctrine\ORM\Query
     */
    public function findByClasse($enfant)
    {
        $fiche = $this->getEntityManager()
            ->createQuery('
                    SELECT i
                    FROM InscriptionBundle:Inscrit i 
                    JOIN i.enfant e 
                    JOIN i.niveau n
                    JOIN e.parent p
                    WHERE  e.id = :enfant
                 ');
        $fiche->setParameter('enfant', $enfant);
        return $fiche->getSingleResult();
    }

    public function findNiveauxEnfants($parentId)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("
            SELECT e.id, e.nom, e.prenom, e.dateNaissance, e.genre, e.activated as isActive, n.classe, i.id as idInscrit
            FROM InscriptionBundle:Inscrit i 
            LEFT JOIN i.niveau n 
            LEFT JOIN i.enfant e 
            LEFT JOIN e.parent p 
            WHERE p.id = :parent_id
        ");
        $query->setParameter('parent_id', $parentId);
        $result = $query->getResult();

        return $result;
    }
}
