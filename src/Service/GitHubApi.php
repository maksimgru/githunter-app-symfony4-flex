<?php

namespace App\Service;

/**
 * Class GitHupApi
 * @package App\Service
 *
 */
class GitHubApi
{
    /**
     * @var HttpClientInterface $httpClient
     */
    private $httpClient;

    /**
     * Create new GitHupApi instance.
     *
     * @param HttpClientInterface $httpClient;
     *
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }


    /**
     * Description:
     *
     * @param STRING $username
     *
     * @return ARRAY
     *
     */
    public function getProfile($username)
    {
        $profileData = $this->httpClient->get('https://api.github.com/users/' . $username);

        return [
            'avatar_url'  => $profileData['avatar_url'],
            'github_url'  => $profileData['html_url'],
            'name'        => $profileData['name'] ?? $profileData['login'],
            'login'       => $profileData['login'],
            'blog'        => $profileData['blog'],
            'details'     => [
                'company'   => $profileData['company'],
                'location'  => $profileData['location'],
                'joined_on' => 'Joined on ' . (new \DateTime($profileData['created_at']))->format('d-m-Y'),
            ],
            'social_data' => [
                'followers'    => $profileData['followers'],
                'following'    => $profileData['following'],
                'public_repos' => $profileData['public_repos'],
            ]
        ];
    }

    /**
     * Description:
     *
     * @param STRING $username
     *
     * @return ARRAY
     *
     */
    public function getRepos($username)
    {
        $reposData = $this->httpClient->get('https://api.github.com/users/' . $username . '/repos');

        return [
            'most_stars' => array_reduce($reposData, function ($mostStars, $currentRepo) {
                return ($currentRepo['stargazers_count'] > $mostStars) ? $currentRepo['stargazers_count'] : $mostStars;
            }, 0),
            'repo_count' => count($reposData),
            'repos' => $reposData,
        ];
    }
}