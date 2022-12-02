<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompaniesController extends AbstractController
{
    #[Route('/companies', name: 'app_companies', methods: ['GET'])]
    public function index(CompanyRepository $repo): Response
    {
        $companies = $repo->findAll();
        $formulaire = $this->createForm(CompanyType::class);

        return $this->render('companies/index.html.twig', [
            'companies' => $companies,
        ]);
    }

    #[Route('/companies/{id}', name: 'show_company', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Company $company): Response
    {
        return $this->render('companies/show.html.twig', [
            'company' =>  $company,
        ]);
    }

    #[Route('/companies/create', name: "add_company", methods: ['GET', 'POST'])]
    public function add(Request $request, CompanyRepository $repo): Response
    {
        $company = new Company();

        $formulaire = $this->createForm(CompanyType::class, $company);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $repo->save($company, true);
            return $this->redirectToRoute('app_companies');
        }

        return $this->render('companies/add.html.twig', [
            'formulaire'    =>  $formulaire->createView(),
            // 'titre'         =>  'Nouvelle compagnie',
        ]);
    }

    #[Route('/companies/modify/{id}', name: "modify_company", methods: ['GET', 'POST'])]
    public function modify(Company $company, Request $request, CompanyRepository $repo): Response
    {
        $formulaire = $this->createForm(CompanyType::class, $company);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $repo->save($company, true);
            return $this->redirectToRoute('app_companies');
        }

        return $this->render('companies/update.html.twig', [
            'formulaire' => $formulaire->createView(),
            // 'titre' => 'Modification de la compagnie ' . $company->getNom(),
        ]);
    }

    #[Route('/companies/delete/{id}', name: "delete_company", methods: ['GET'])]
    public function delete(Company $company, CompanyRepository $repo): Response
    {
        $repo->remove($company, true);
        return $this->redirectToRoute('app_companies');
    }
}
