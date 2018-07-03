<?php

namespace App\Service;


use App\Model\Comment;
use App\Model\Issue;
use App\Github\Client;

class Issues
{

    public const PER_PAGE = 4;

    /** @var Client */
    private $githubClient;

    /**
     * @param Client $githubClient
     */
    public function __construct(Client $githubClient)
    {
        $this->githubClient = $githubClient;
    }

    /**
     * @param int $issueNumber
     * @return Issue
     */
    public function findOne(int $issueNumber): Issue
    {
        $rawIssue = $this->githubClient->findOne($issueNumber);
        $issue = Issue::createFromArray($rawIssue);

        if ($issue->getCommentsCount() > 0) {
            $rawComments = $this->githubClient->getComments($issueNumber);

            $comments = [];
            foreach ($rawComments as $rawComment) {
                $comments[] = Comment::createFromArray($rawComment);
            }

            $issue->setComments($comments);
        }

        return $issue;
    }


    /**
     * @param int $page
     * @return Issue[]
     */
    public function getList(int $page = 1): array
    {
        $rawIssues = $this->githubClient->getList($page, self::PER_PAGE);

        $list = [];
        foreach ($rawIssues as $rawIssue) {
            $list[] = Issue::createFromArray($rawIssue);
        }

        return $list;
    }

    /**
     * @return array
     */
    public function getCounts(): array
    {
        $counts = [
            $this->githubClient::STATE_OPEN => $this->githubClient->getCount($this->githubClient::STATE_OPEN),
            $this->githubClient::STATE_CLOSED => $this->githubClient->getCount($this->githubClient::STATE_CLOSED),
        ];

        return $counts;
    }

}
