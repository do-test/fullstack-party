<?php

namespace App\Github;

use Github\Client as GithubClient;

class Client
{
    public const STATE_ALL  = 'all';
    public const STATE_OPEN = 'open';
    public const STATE_CLOSED  = 'closed';

    private const COUNTABLE_STATES = [self::STATE_OPEN, self::STATE_CLOSED];

    /** @var string */
    private $repoUser;

    /** @var string */
    private $repoName;

    /** @var GithubClient */
    private $client;

    /**
     * @param string $repoUser
     * @param string $repoName
     * @param GithubClient $client
     */
    public function __construct(string $repoUser, string $repoName, GithubClient $client)
    {
        $this->repoUser = $repoUser;
        $this->repoName = $repoName;
        $this->client = $client;
    }

    /**
     * @param int $issueNumber
     * @return array
     */
    public function findOne(int $issueNumber): array
    {
        $issue = $this->client
            ->issue()
            ->show($this->repoUser, $this->repoName, $issueNumber);

        return $issue;
    }

    /**
     * @param int $issueNumber
     * @return array
     */
    public function getComments(int $issueNumber): array
    {
        $comments = $this->client
            ->issue()
            ->comments()
            ->all($this->repoUser, $this->repoName, $issueNumber);

        return $comments;
    }

    /**
     * @param int $page
     * @param int $perPage
     * @return array
     */
    public function getList(int $page = 1, int $perPage = 4): array
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage,
            'state' => self::STATE_ALL
        ];

        $issues = $this->client
            ->issue()
            // unfortunately this way of setting pagination does not work, no need to debug now
            //->setPage($page)->setPerPage(self::PER_PAGE)
            ->all($this->repoUser, $this->repoName, $params);

        return $issues;
    }

    /**
     * @param string $state
     * @return int
     */
    public function getCount(string $state): int
    {
        if (!in_array($state, self::COUNTABLE_STATES)) {
            return 0;
        }

        $query = sprintf('repo:%s/%s state:%s type:issue', $this->repoUser, $this->repoName, $state);

        $searchResult = $this->client
            ->search()
            ->setPerPage(1) // one item per page to limit the amount of unneeded data
            ->issues($query);

        return !empty($searchResult['total_count']) ? (int)$searchResult['total_count'] : 0;
    }
}
