<?php

namespace App\Controller;

use App\Repository\VilleRepository;
use App\Repository\CompanyRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompaniesController extends AbstractController
{
    #[Route('/companies', name: 'app_companies')]
    public function index(CompanyRepository $repo): Response
    {
        $companies = $repo->findAll();

        return $this->render('companies/index.html.twig', [
            'companies' => $companies,
        ]);
    }

    #[Route('/companies/{id}', name: "show_company")]
    public function show(Request $request, CompanyRepository $repo): Response
    {
        $id = $request->attributes->get('id');
        $company = $repo->find($id);

        return $this->render('companies/show.html.twig', [
            'company' => $company,
        ]);
    }
}
