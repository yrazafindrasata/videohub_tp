<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UserController extends  AbstractController
{
    /**
     * @Route("/user", name="profileUser")
     */
    public function seeUser(Request $request,EntityManagerInterface $em,UserRepository $userRepository)
    {
        $id=$_GET['id'];
        $user =$userRepository->find($id);
        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/user/{id}", name="profileUserEdit")
     */
    public function profile(User $user,Request $request,EntityManagerInterface $em)
    {
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()) {
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('account');
        }
        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/account", name="account")
     */
    public function myAccount(Request $request)
    {

        return $this->render('user/userProfile.html.twig');
    }


}