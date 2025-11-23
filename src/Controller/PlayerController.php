<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Player;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;

final class PlayerController extends AbstractController
{
    #[Route('/', name: 'app_player')]
    public function index(
        EntityManagerInterface $em,
        PlayerRepository $playerRepository,
        Request $request
    ): Response
    {
        $data = $request->request->all();
        if(isset($data["add"])){
            $player = new Player();
            $player->setFirstname($data["firstname"]);
            $player->setLastname($data["lastname"]);
            $player->setPoste($data["poste"]);
            $player->setNumber($data["number"]);

            $em->persist($player);
            $em->flush();
        }
        $all_players = $playerRepository->findAll();
        return $this->render('player/index.html.twig', [
            'all_players' => $all_players,
        ]);
    }
    
    #[Route('/add-update', name: 'app_add_update_player')]
    public function addOrUpdate(
        EntityManagerInterface $em,
        PlayerRepository $playerRepository,
        Request $request
    ): Response
    {
        $data = $request->request->all();
        if(isset($data["add"])){
            $player = new Player();
            $player->setFirstname($data["firstname"]);
            $player->setLastname($data["lastname"]);
            $player->setPoste($data["poste"]);
            $player->setNumber($data["number"]);

            $em->persist($player);
            $em->flush();
            $this->addFlash("success", "Player added successfully");
        }
        return $this->redirectToRoute("app_player");
    }
}
