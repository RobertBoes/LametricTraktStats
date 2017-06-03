<?php

namespace RobertBoes\LaMetricTrakt;

use Dotenv\Dotenv;

class Trakt
{
    private $user, $category, $stats_type;

    /**
     * @var Api
     */
    private $api;

    /**
     * @var Response
     */
    private $response;

    private $requiredParameters = [
        'user',
        'category',
        'stats_type'
    ];

    public function __construct() {
        $dotenv = new Dotenv(__DIR__ . '/../../');
        $dotenv->load();
    }

    public function parseRequest($getVariables) {
        foreach ($this->requiredParameters as $name) {
            if (empty($getVariables[$name])) {
                throw new \Exception('Missing parameter');
            }
            $this->{$name} = strtolower(addslashes(urldecode($getVariables[$name])));
        }
        $this->api = new Api();
        $this->response = new Response();
    }

    public function getResult() {
        $result = $this->api
            ->getStats($this->user)
            ->getData($this->category, $this->stats_type);
        return $this->response->data($result);
    }

    public function error($message) {
        return $this->response->error($message);
    }
}
