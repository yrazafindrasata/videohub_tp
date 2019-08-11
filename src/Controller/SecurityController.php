<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Video;
use App\Form\LoginUserType;
use App\Form\RegisterUserType;
use App\Form\AddVideoType;
use App\Repository\UserRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepository ,EntityManagerInterface $em)
    {
        $user = new User();
        $form = $this->createForm(RegisterUserType::class, $user);
        $form ->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $em->persist($user);
            $em->flush();
        }

        return $this->render('security/RegisterUser.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $user = new User();
        $form = $this->createForm(LoginUserType::class, $user);
        return $this->render('security/login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile(Request $request, VideoRepository $videoRepository, EntityManagerInterface $em)
    {

        $video = new Video();
        $form = $this->createForm(AddVideoType::class,$video);
        $form->handleRequest($request);

        if($form->isSubmitted()&&$form->isValid()) {
            $em->persist($video);
            $em->flush();
        }

        return $this->render('video/profileVideo.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
