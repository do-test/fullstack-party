<?php

namespace App\Tests\Service;

use App\Service\Issues;
use App\Github\Client;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class IssuesTest extends TestCase
{

    /** @var Client|MockObject */
    private $githubClient;

    /** @var Issues */
    private $issues;

    /** @var Serializer */
    private $serializer;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);

        parent::__construct($name, $data, $dataName);
    }

    public function setUp()
    {
        $this->githubClient = $this->createMock(Client::class);
        $this->issues = new Issues($this->githubClient);
    }

    public function testFindOne()
    {
        $this
            ->githubClient
            ->method('findOne')
            ->willReturn(json_decode(file_get_contents('tests/Fixtures/issue.json'), true))
        ;

        $this
            ->githubClient
            ->method('getComments')
            ->willReturn(json_decode(file_get_contents('tests/Fixtures/comments.json'), true))
        ;


        $expected = require 'tests/Expected/issue.php';
        $actual = $this->serializer->normalize($this->issues->findOne(1));

        $this->assertEquals($expected, $actual);
    }

    public function testGetList()
    {
        $this
            ->githubClient
            ->method('getList')
            ->willReturn(json_decode(file_get_contents('tests/Fixtures/issues.json'), true))
        ;

        $expected = require 'tests/Expected/issues.php';
        $actual = $this->serializer->normalize($this->issues->getList(1));

        $this->assertEquals($expected, $actual);
    }

    public function testGetCounts()
    {
        $this
            ->githubClient
            ->method('getCount')
            ->withConsecutive([$this->githubClient::STATE_OPEN], [$this->githubClient::STATE_CLOSED])
            ->willReturnOnConsecutiveCalls(10, 20)
        ;

        $expected = [
            $this->githubClient::STATE_OPEN => 10,
            $this->githubClient::STATE_CLOSED => 20,
        ];
        $actual = $this->issues->getCounts();

        $this->assertEquals($expected, $actual);
    }

}
