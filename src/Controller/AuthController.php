<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\Provider\GithubClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends Controller
{

    /** @var GithubClient */
    private $oauthClient;

    /**
     * @param GithubClient $oauthClient
     */
    public function __construct(GithubClient $oauthClient)
    {
        $this->oauthClient = $oauthClient;
    }

    /**
     * This is the / route, defined in routes.yaml
     *
     * @return Response
     */
    public function index(): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('issues');
        }

        return $this->render('auth/index.html.twig');
    }

    /**
     * @Route("/auth/login", name="login", methods={"GET"})
     */
    public function login(): Response
    {
        return $this->oauthClient->redirect();
    }

    /**
     * @Route("/auth/logout", name="logout", methods={"GET"})
     */
    public function logout(): Response
    {
        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/auth/check", name="login_check", methods={"GET"})
     */
    public function authCheck(): Response
    {
        return $this->redirectToRoute('issues');
    }
}
