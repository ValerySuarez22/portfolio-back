<?php

namespace App\Controller;

use App\Entity\Projects;
use App\Form\ProjectsType;
use App\Repository\ProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/apiprojects')]
class ApiController extends AbstractController
{
    #[Route('/list', name: 'app_apiprojects_index', methods: ['GET'])]
    public function index(ProjectsRepository $projectsRepository): Response
    {
        $projects = $projectsRepository->findAll();

        $data = [];

        foreach ($projects as $p) {
            $data[] = [
                'id' => $p->getId(),
                'name' => $p->getName(),
                'description' => $p->getDescription(),
                'images' => $p->getImages(),
                'stacks' => $p->getStacks(),
            ];
            
        }

        //dump($data);die; 
        //return $this->json($data);
        return $this->json($data, $status = 200, $headers = ['Access-Control-Allow-Origin'=>'*']);
    }
}
