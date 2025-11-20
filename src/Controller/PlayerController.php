<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;

final class PlayerController extends AbstractController
{
    #[Route('/', name: 'app_player')]
    public function index(
        EntityManagerInterface $em,
        PlayerRepository $playerRepository
    ): Response
    {
        $all_players = $playerRepository->findAll();
        return $this->render('player/index.html.twig', [
            'all_players' => $all_players,
        ]);
    }
}
