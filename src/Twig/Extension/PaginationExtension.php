<?php

namespace App\Twig\Extension;

use Knp\Bundle\PaginatorBundle\Helper\Processor;
use Knp\Bundle\PaginatorBundle\Twig\Extension\PaginationExtension as KnpPaginationExtension;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Knp\Component\Pager\Paginator;
use Twig_Environment;
use Twig_SimpleFunction;

class PaginationExtension extends KnpPaginationExtension
{

    /** @var Processor */
    protected $processor;

    /** @var Paginator */
    protected $paginator;

    public function __construct(Processor $processor, Paginator $paginator)
    {
        $this->processor = $processor;
        $this->paginator = $paginator;

        parent::__construct($processor);
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction(
                'app_paginate',
                [$this, 'paginate'],
                ['is_safe' => ['html'], 'needs_environment' => true]
            )
        ];
    }

    /**
     * Takes pagination parameters from the template and renders pagination template
     *
     * @param Twig_Environment $env
     * @param array $params
     * @param string $template
     * @param array $queryParams
     * @param array $viewParams
     * @return string
     */
    public function paginate(
        Twig_Environment $env,
        array $params,
        $template = null,
        array $queryParams = [],
        array $viewParams = []
    ) {
        $pagination = $this->getPagination($params);

        return parent::render($env, $pagination, $template, $queryParams, $viewParams);
    }

    /**
     * @param array $params
     * @return SlidingPagination
     */
    private function getPagination(array $params): SlidingPagination
    {
        /** @var SlidingPagination $pagination */
        $pagination = $this->paginator->paginate([]);

        // set default values
        $page = $pagination->getCurrentPageNumber();
        $perPage = $pagination->getItemNumberPerPage();
        $totalItems = $pagination->getTotalItemCount();

        // filter and extract custom values
        $params = array_intersect_key($params, array_flip(['page', 'perPage', 'totalItems']));
        $params = array_map('intval', $params);
        extract($params);

        $pagination->setCurrentPageNumber($page);
        $pagination->setItemNumberPerPage($perPage);
        $pagination->setTotalItemCount($totalItems);

        return $pagination;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_pagination';
    }
}
