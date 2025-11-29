<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Player;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;

final class PlayerController extends AbstractController
{
    #[Route('/', name: 'app_player')]
    public function index(
        PlayerRepository $playerRepository,
    ): Response
    {
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

        else if(isset($data["update"])){
            $player = $playerRepository->find($data["id"]);
            // $player->setFirstname($data["firstname"]);
            $player->setLastname($data["lastname"]);
            $player->setPoste($data["poste"]);
            $player->setNumber($data["number"]);

            $em->persist($player);
            $em->flush();
        }

        return $this->redirectToRoute("app_player");
    }
    
    #[Route('/delete', name: 'api_delete_player_by_id')]
    public function DeleteById(
        PlayerRepository $playerRepository,
        Request $request,
        EntityManagerInterface $em
    ): Response
    {
        $id = $request->request->all()['id'];
        $player = $playerRepository->find($id);
        $em->remove($player);
        $em->flush();

        return $this->redirectToRoute("app_player");
    }
    
    #[Route('/api/player/{id}', name: 'api_get_player_by_id')]
    public function apiGetPlayerById(
        PlayerRepository $playerRepository,
        int $id
    ): JsonResponse
    {
        $player = $playerRepository->find($id);
        return $this->json([
            'lastname' => $player->getLastname(),
            // 'firstname' => $player->getFirstname(),
            'poste' => $player->getPoste(),
            'number' => $player->getNumber(),
        ]);
    }
}
