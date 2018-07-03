<?php

namespace App\Controller;

use App\Service\Issues;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("has_role('ROLE_USER')")
 */
class IssuesController extends Controller
{

    /** @var Issues */
    private $issues;

    public function __construct(Issues $issues)
    {
        $this->issues = $issues;
    }

    /**
     * @Route("/issues/{page}", name="issues", requirements={"page"="\d+"}, methods={"GET"})
     * @param Request $request
     * @param int $page
     * @return Response
     */
    public function issues(Request $request, int $page = 1): Response
    {
        $issues = $this->issues->getList($page);
        $totals = $this->issues->getCounts();

        $data = [
            'issues' => $issues,
            'totals' => $totals,
            'currentPage' => $page,
            'perPage' => $this->issues::PER_PAGE,
            'totalItems' => array_sum($totals),
        ];

        if ($request->isXmlHttpRequest()) {
            return $this->json($data);
        }

        return $this->render('issues/list.html.twig', $data);
    }

    /**
     * @Route("/issue/{issueNumber}", name="issues_item", requirements={"issueNumber"="\d+"}, methods={"GET"})
     * @param Request $request
     * @param int $issueNumber
     * @return Response
     */
    public function issuesItem(Request $request, int $issueNumber): Response
    {
        $issue = $this->issues->findOne($issueNumber);

        if ($request->isXmlHttpRequest()) {
            return $this->json($issue);
        }

        return $this->render('issues/item.html.twig', [
            'issue' => $issue,
        ]);
    }
}
