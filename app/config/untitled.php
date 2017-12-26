<?php

namespace AppBundle\Controller\ApiRest;


use AppBundle\Entity\Customer;
use AppBundle\Entity\Depository;
use AppBundle\Entity\Equipement;
use AppBundle\Entity\Intervention;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @REST\NamePrefix("api_intervention_")
 */
class InterventionController extends Controller
{
    /**
     * @return mixed
     *
     * @Rest\View(statusCode=Response::HTTP_OK)
     * @Rest\Get("/v1/technician/interventions/lots")
     */
    public function getInterventionsAction()
    {
     $em = $this->getDoctrine()->getManager();
     $technician = $this->getUser();
     $interventions = $em->getRepository(Intervention::class)->getInterventions($technician);

     if (empty($interventions)) {
        throw $this->createNotFoundException();
     }

     foreach ($interventions as $intervention) {
         $dueDateAndDepositoryId = $intervention->getDueDate()->format('Y-m-d H:i:s') . ':'
                            . $intervention->getEquipement()->getDepository()->getId();

         $equipement = $intervention->getEquipement();
         $customer   = $equipement->getDepository()->getCustomer();
         $depository = $equipement->getDepository();

         $InterventionsArray = [
             'id' => $intervention->getId(),
             'due_date' => $intervention->getDueDate(),
             'referentiel' => $intervention->getReferential()->getName(),
             'mission_type' => $intervention->getMissionType()->getName(),
             'commentaire' => $intervention->getComment(),
             'equipement_id' => $intervention->getEquipement()->getId(),
         ];

         if (isset($listeInterventions[$dueDateAndDepositoryId])) {
             $listInterventions[$dueDateAndDepositoryId][] = $InterventionsArray;
         } else {
             $listInterventions[$dueDateAndDepositoryId] = [$InterventionsArray];
         }

         $depositoriesId[]  = $depository->getId();
         $customersId[]     = $customer->getId();
         $equipementsId[]   = $equipement->getId();
     }

    foreach ($listInterventions as $key => $value) {
        if ($dueDateAndDepositoryId === $key) {
            $lotIntervention[] = ['intervention' => $value];
        } else {
            $lotIntervention[] = ['intervention' => $value];
        }
    }

     $listDepositories = $this->getDepositories($depositoriesId);
     $listCustomers    = $this->getCustomers($customersId);
     $listEquipements   = $this->getEquipements($equipementsId);

     return [
         'Interventions' => $lotIntervention,
         'Depositories'  => $listDepositories,
         'Customers'     => $listCustomers,
         'Equipements'   => $listEquipements
     ];
    }

    /**
     * @param $depositoriesId
     * @return mixed
     */
    public function getDepositories($depositoriesId)
    {
        $em = $this->getDoctrine()->getManager();
        $depositories = $em->getRepository(Depository::class)->getDepository($depositoriesId);

        if (empty($depositories)) {
            throw $this->createNotFoundException();
        }

        foreach ($depositories as $depository) {

            $DepositoriesArray = [
                'id' => $depository->getId(),
                'name' => $depository->getName(),
                'building_name' => $depository->getBuildingName(),
                'building_document' => $depository->getBuildingDocument(),
                'location' => [
                    'address' => $depository->getAddress(),
                    'additional_address' => $depository->getAdditionalAddress(),
                    'postal_code' => $depository->getLocation()->getPostalCode(),
                    'city' => $depository->getLocation()->getCity(),
                    'coordonnee_gps' => [
                        'latitude' => $depository->getLatitude(),
                        'longitude' => $depository->getLongitude()
                    ],
                ],
                'building_information' => $depository->getBuildingInformations(),
                'photo' => [
                    'photo_name' => $depository->getPhotoName(),
                    'photo_file' => $depository->getPhotoFile()
                ],
                'plan_prevention' => $depository->getPreventionPlanFileName(),
                'customer_id' => $depository->getCustomer()->getId()
            ];

            $listDepositories[] = $DepositoriesArray;
        };

        return $listDepositories;
    }

    /**
     * @param $customersId
     * @return array
     */
    public function getCustomers($customersId)
    {
        $em = $this->getDoctrine()->getManager();
        $customers = $em->getRepository(Customer::class)->getCustomer($customersId);

        if (empty($customers)) {
            throw $this->createNotFoundException();
        }

        foreach ($customers as $customer) {
            $CustomerArray = [
                'id' => $customer->getId(),
                'name' => $customer->getName()
            ];
            $listCustomers[] = $CustomerArray;
        };

        return $listCustomers;
    }

    public function getEquipements($equipementsId)
    {
        $em = $this->getDoctrine()->getManager();
        $equipements = $em->getRepository(Equipement::class)->getEquipement($equipementsId);

        if (empty($equipements)) {
            throw $this->createNotFoundException();
        }

        foreach ($equipements as $equipement) {
            $EquipementArray = [
                'id' => $equipement->getId(),
                'is_active' => $equipement->isActivated(),
                'serial_number' => $equipement->getSerialNumber(),
                'internal_number' => $equipement->getInternalNumber(),
                'category_id' => 'to do',
                'brand' => $equipement->getBrand(),
                'type' => $equipement->getType(),
                'created_year' => $equipement->getCraftedYear(),
                'elevation_height' => $equipement->getElevationHeight(),
                'cdg_range' => $equipement->getCdgRange(),
                'max_weight' => $equipement->getMaxWeight(),
                'power_id' => $equipement->getPower()->getId(),
                'lifting_set_id' => $equipement->getLiftingSet()->getId(),
                'comment' => $equipement->getComment(),
                'conformity_declaration' => $equipement->getConformityDeclaration(),
                'marking' => $equipement->getMarking(),
                'examination' => $equipement->getExamination(),
                'date_examination' => $equipement->getExaminationDate(),
                'instruction_manuel' => $equipement->getInstructionManual(),
                'maintenance_book' => $equipement->getMaintenanceBook(),
                'vgp' => $equipement->getVgp(),
                'hour_meter' => $equipement->getHourMeter(),
            ];
            $listEquipements[] = $EquipementArray;
        };

        return $listEquipements;
    }
}