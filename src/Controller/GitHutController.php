<?php

namespace App\Controller;

use App\Service\GitHubApi;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class GitHutController
 * @package App\Controller
 *
 */
class GitHutController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @return RedirectResponse
     *
     */
    public function indexAction()
    {
        return $this->redirectToRoute('githut');
    }

    /**
     * @Route("/githut/{username}", name="githut", defaults={"username" : "maksimgru"})
     *
     * @param Request $request
     * @param STRING $username
     *
     * @return Response
     *
     */
    public function githutAction(Request $request, $username)
    {
        $templateData = [
            'username' => $username,
            'request' => $request
        ];

        return $this->render('githut/index.html.twig', $templateData);
    }

    /**
     * Description:
     *
     * @Route("/githut/profile/{username}", name="profile", defaults={"username" : "maksimgru"})
     *
     * @param string $username
     * @param GitHubApi $api
     *
     * @return Response
     *
     */
    public function profileAction($username, GitHubApi $api)
    {
        $profileData = $api->getProfile($username);
        $templateData = $profileData;

        return $this->render('githut/profile.html.twig', $templateData);
    }

    /**
     * Description:
     *
     * @Route("/githut/repos/{username}", name="repos", defaults={"username" : "maksimgru"})
     *
     * @param string $username
     * @param GitHubApi $api
     *
     * @return Response
     *
     */
    public function reposAction($username, GitHubApi $api)
    {
        $reposData = $api->getRepos($username);
        $templateData = $reposData;

        return $this->render('githut/repos.html.twig', $templateData);
    }
}
