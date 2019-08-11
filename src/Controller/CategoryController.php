<?php


namespace App\Controller;

use App\Entity\Category;
use App\Manager\VideoManager;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="videosCategory")
     */
    public function seeVideoCategory(Request $request,EntityManagerInterface $em,VideoManager $vm)
    {
        $idCategory=$_GET['id'];
        $videosPublishedCategory = $vm->getPublishedVideosByCategory($idCategory);
        return $this->render('category/index.html.twig', [
            'videosPublished' => $videosPublishedCategory,
        ]);
    }
}