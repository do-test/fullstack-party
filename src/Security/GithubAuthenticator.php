<?php

namespace App\Security;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class GithubAuthenticator extends SocialAuthenticator
{
    /** @var ClientRegistry */
    private $clientRegistry;

    /** @var TokenStorageInterface */
    private $tokenStorage;

    /** @var RouterInterface */
    private $router;

    public function __construct(
        ClientRegistry $clientRegistry,
        TokenStorageInterface $tokenStorage,
        RouterInterface $router
    ) {
        $this->clientRegistry = $clientRegistry;
        $this->tokenStorage = $tokenStorage;
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function supports(Request $request): bool
    {
        return $request->attributes->get('_route') === 'login_check';
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getCredentials(Request $request): array
    {
        $client = $this->clientRegistry->getClient('github');
        $accessToken = $client->getAccessToken();

        return $accessToken->jsonSerialize();
    }

    /**
     * @param array $credentials
     * @param UserProviderInterface $userProvider
     * @return null|UserInterface
     */
    public function getUser($credentials, UserProviderInterface $userProvider): ?UserInterface
    {
        if (!is_array($credentials) || empty($credentials['access_token'])) {
            return null;
        }

        return $userProvider->loadUserByUsername($credentials['access_token']);
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     * @return Response
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey): Response
    {
        $this->tokenStorage->setToken($token);

        return new RedirectResponse($this->router->generate('issues'));
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        $session = new Session();
        $session->getFlashBag()->add('error', $exception->getMessage());

        return new RedirectResponse($this->router->generate('index'));
    }

    /**
     * @param Request $request
     * @param AuthenticationException|null $authException
     * @return Response
     */
    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        if ($request->isXmlHttpRequest()) {
            return new JsonResponse('Authentication Required', Response::HTTP_UNAUTHORIZED);
        }

        return new RedirectResponse($this->router->generate('index'));
    }
}
