<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    
    #[Route('/', name:"home" )]
    public function home(): Response
    {
        $favicon='/assets/images/favicon.png';

        return $this->render('/home.html.twig', [
            'favicon' => $favicon,
        ]);
    }

    #[Route('/trader/admin/', name:'trader_admin')]
    public function trader_admin(): Response
    {
        return $this->render('/trader/admin/index.html.twig');
    }

    

    #[Route('/trader/admin/categories/', name: 'trader_admin_categories')]
    public function show_categories(): Response
    {
        return $this->render('/trader/admin/categories.html.twig',);
    }

    #[Route('/trader/admin/products/', name: 'trader_admin_products')]
    public function show_products(): Response
    {
        return $this->render('/trader/admin/products.html.twig',);
    }
}