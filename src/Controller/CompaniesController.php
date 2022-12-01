<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompaniesController extends AbstractController
{
    #[Route('/companies', name: 'app_companies')]
    public function index(CompanyRepository $repo): Response
    {
        $companies = $repo->findAll();
        $formulaire = $this->createForm(CompanyType::class);

        return $this->render('companies/index.html.twig', [
            'companies' => $companies,
        ]);
    }


    #[Route('/companies/{id}', name: 'show_company', requirements: ['id' => '\d+'])]
    public function show(Company $company): Response
    {
        return $this->render('companies/show.html.twig', [
            'company' =>  $company,
        ]);
    }

    #[Route('/companies/create', name: "add_company")]
    public function add(): Response
    {
        $formulaire = $this->createForm(CompanyType::class);

        return $this->render('companies/add.html.twig', [
            'formulaire'    =>  $formulaire->createView(),
        ]);
    }
}
