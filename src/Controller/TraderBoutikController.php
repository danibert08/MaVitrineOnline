<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TraderBoutikController extends AbstractController
{

    

    #[Route('/trader/home/', name:'trader_home')]
    public function trader_home(): Response
    {
        $json_path = '../templates/trader/boutik/datas.json';
        $data = [];

    if (file_exists($json_path)) {
        $json_content = file_get_contents($json_path);
        $data = json_decode($json_content, true);
    }else {
    // Petit message de debug pour la prod
    die("Erreur : Le fichier est introuvable à l'adresse : " . $json_path);
    }
        return $this->render('/trader/boutik/home.html.twig',[
                    'data' => $data,
        ]);
    }

    #[Route('/trader/boutik/mentions/', name:'trader_boutik_mentions')]
    public function trader_mentions(): Response
    {
        $json_path = '../templates/trader/boutik/datas.json';
        $data = [];

    if (file_exists($json_path)) {
        $json_content = file_get_contents($json_path);
        $data = json_decode($json_content, true);
    }else {
    // Petit message de debug pour la prod
    die("Erreur : Le fichier est introuvable à l'adresse : " . $json_path);
    }
        return $this->render('/trader/boutik/mentions.html.twig',[
                'data' => $data
        ]);
    }

    #[Route('/trader/boutik/manucure/', name:'trader_boutik_manucure')]
    public function trader_manucure(): Response
    {
        $json_path = '../templates/trader/boutik/datas.json';
        $data = [];

    if (file_exists($json_path)) {
        $json_content = file_get_contents($json_path);
        $data = json_decode($json_content, true);
    }else {
    // Petit message de debug pour la prod
    die("Erreur : Le fichier est introuvable à l'adresse : " . $json_path);
    }
        $images=[];
    for ($i=1;$i<13;$i++){
        $images[] = "m$i";
    }
    
        return $this->render('/trader/boutik/manucure.html.twig',[
                'data' => $data,
                'images' => $images,
        ]);
    }
    
    #[Route('/trader/boutik/pedicure/', name:'trader_boutik_pedicure')]
    public function trader_pedicure(): Response
    {
        $json_path = '../templates/trader/boutik/datas.json';
        $data = [];

    if (file_exists($json_path)) {
        $json_content = file_get_contents($json_path);
        $data = json_decode($json_content, true);
    }else {
    // Petit message de debug pour la prod
    die("Erreur : Le fichier est introuvable à l'adresse : " . $json_path);
    }
        $images=[];
    for ($i=1;$i<7;$i++){
        $images[] = "p$i";
    }
    
        return $this->render('/trader/boutik/pedicure.html.twig',[
                'data' => $data,
                'images' => $images,
        ]);
    }

    #[Route('/trader/boutik/maquillage/', name:'trader_boutik_maquillage')]
    public function trader_maquillage(): Response
    {
        $json_path = '../templates/trader/boutik/datas.json';
        $data = [];

    if (file_exists($json_path)) {
        $json_content = file_get_contents($json_path);
        $data = json_decode($json_content, true);
    }else {
    // Petit message de debug pour la prod
    die("Erreur : Le fichier est introuvable à l'adresse : " . $json_path);
    }
        $images=[];
    for ($i=1;$i<11;$i++){
        $images[] = "v$i";
    }
    
        return $this->render('/trader/boutik/maquillage.html.twig',[
                'data' => $data,
                'images' => $images,
        ]);
    }



}