<?php

return [
    [
        'id' => 337665736,
        'number' => 27809,
        'title' => '[HttpFoundation] Fix tests: new message for status 425',
        'createdAt' => [
            'timezone' => [
                'name' => 'Z',
                'transitions' => false,
                'location' => false,
            ],
            'offset' => 0,
            'timestamp' => 1530566098,
        ],
        'commentsCount' => 0,
        'comments' => [],
        'user' => [
            'id' => 57224,
            'login' => 'dunglas',
            'avatarUrl' => 'https://avatars2.githubusercontent.com/u/57224?v=4',
        ],
        'body' => "| Q             | A\r\n| ------------- | ---\r\n| Branch?       | 2.8\r\n| Bug fix?      | yes\r\n| New feature?  | no <!-- don't forget to update src/**/CHANGELOG.md files -->\r\n| BC breaks?    | no     <!-- see https://symfony.com/bc -->\r\n| Deprecations? | no <!-- don't forget to update UPGRADE-*.md and src/**/CHANGELOG.md files -->\r\n| Tests pass?   | yes    <!-- please add some, will be required by reviewers -->\r\n| Fixed tickets | n/a   <!-- #-prefixed issue number(s), if any -->\r\n| License       | MIT\r\n| Doc PR        | n/a\r\n\r\nMakes tests green.\r\nThe new meaning of 425 is defined here: https://datatracker.ietf.org/doc/draft-ietf-httpbis-replay/?include_text=1",
        'labels' => [
            [
                'color' => 'e10c02',
                'name' => 'Bug',
            ],
            [
                'color' => 'DDDDDD',
                'name' => 'HttpFoundation',
            ],
            [
                'color' => 'ededed',
                'name' => 'Status: Needs Review',
            ],
        ],
        'state' => 'open',
    ],
    [
        'id' => 337618649,
        'number' => 27808,
        'title' => '[DI] Deprecate non-string default envs',
        'createdAt' => [
            'timezone' => [
                'name' => 'Z',
                'transitions' => false,
                'location' => false,
            ],
            'offset' => 0,
            'timestamp' => 1530556031,
        ],
        'commentsCount' => 3,
        'comments' => [],
        'user' => [
            'id' => 1047696,
            'login' => 'ro0NL',
            'avatarUrl' => 'https://avatars0.githubusercontent.com/u/1047696?v=4',
        ],
        'body' => "| Q             | A\r\n| ------------- | ---\r\n| Branch?       | master\r\n| Bug fix?      | yes-ish\r\n| New feature?  | yes\r\n| BC breaks?    | no     <!-- see https://symfony.com/bc -->\r\n| Deprecations? | yes\r\n| Tests pass?   | no    <!-- please add some, will be required by reviewers -->\r\n| Fixed tickets | #27680, https://github.com/symfony/symfony/pull/27470#discussion_r196678923\r\n| License       | MIT\r\n| Doc PR        | symfony/symfony-docs#... <!-- required for new features -->\r\n\r\nThis is a failing test to further clarify the issues raised in #27680 \r\n\r\nSo given https://github.com/symfony/symfony/issues/27680#issuecomment-399402480\r\n\r\n> We should be sure this solves a real-world issue.\r\n\r\nI think it solves a real bug :)",
        'labels' => [
            [
                'color' => 'e10c02',
                'name' => 'Bug',
            ],
            [
                'color' => 'DDDDDD',
                'name' => 'DependencyInjection',
            ],
            [
                'color' => 'f1c40f',
                'name' => 'Deprecation',
            ],
            [
                'color' => '02e10c',
                'name' => 'Feature',
            ],
            [
                'color' => 'ededed',
                'name' => 'Status: Needs Review',
            ],
        ],
        'state' => 'open',
    ],
    [
        'id' => 337618436,
        'number' => 27807,
        'title' => 'Added new methods submitForm and clickLink to Client class',
        'createdAt' => [
            'timezone' => [
                'name' => 'Z',
                'transitions' => false,
                'location' => false,
            ],
            'offset' => 0,
            'timestamp' => 1530555992,
        ],
        'commentsCount' => 3,
        'comments' => [],
        'user' => [
            'id' => 8058373,
            'login' => 'nowiko',
            'avatarUrl' => 'https://avatars1.githubusercontent.com/u/8058373?v=4',
        ],
        'body' => "| Q             | A\r\n| ------------- | ---\r\n| Branch?       | master\r\n| Bug fix?      | no\r\n| New feature?  | yes\r\n| BC breaks?    | no\r\n| Deprecations? | no\r\n| Tests pass?   | yes\r\n| License       | MIT\r\n\r\nAdded new methods to BrowserKit/Client to simplify work with links and forms.\r\nRelated to https://github.com/symfony/symfony/issues/27627",
        'labels' => [
            [
                'color' => '02e10c',
                'name' => 'Feature',
            ],
            [
                'color' => 'fad8c7',
                'name' => 'Status: Needs Work',
            ],
        ],
        'state' => 'open',
    ],
    [
        'id' => 337544108,
        'number' => 27806,
        'title' => '[DI] Allow autoconfiguring bindings',
        'createdAt' => [
            'timezone' => [
                'name' => 'Z',
                'transitions' => false,
                'location' => false,
            ],
            'offset' => 0,
            'timestamp' => 1530541960,
        ],
        'commentsCount' => 0,
        'comments' => [],
        'user' => [
            'id' => 243674,
            'login' => 'nicolas-grekas',
            'avatarUrl' => 'https://avatars3.githubusercontent.com/u/243674?v=4',
        ],
        'body' => "| Q             | A\r\n| ------------- | ---\r\n| Branch?       | master\r\n| Bug fix?      | no\r\n| New feature?  | yes\r\n| BC breaks?    | no\r\n| Deprecations? | no\r\n| Tests pass?   | yes\r\n| Fixed tickets | -\r\n| License       | MIT\r\n| Doc PR        | -\r\n\r\nI've come up with a case where we will need to inject a different service based on which interfaces a consumer service implements.\r\n\r\nThe use case is attached: injecting a different token storage for monolog processor than for everything else. It doesn't make sense yet, but there are two missing pieces:  #27801 and another PR I'm about to submit soon.\r\n\r\nTechnically, this can be merged independently.",
        'labels' => [
            [
                'color' => 'DDDDDD',
                'name' => 'DependencyInjection',
            ],
            [
                'color' => '02e10c',
                'name' => 'Feature',
            ],
            [
                'color' => 'ededed',
                'name' => 'Status: Needs Review',
            ],
        ],
        'state' => 'open',
    ],
];
