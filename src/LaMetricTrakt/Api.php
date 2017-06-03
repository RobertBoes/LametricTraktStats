<?php

namespace RobertBoes\LaMetricTrakt;

use GuzzleHttp\Client;

class Api
{
    private $trakt_client_id;
    private $data;

    public function __construct()
    {
        $this->trakt_client_id = getenv('TRAKT_CLIENT_ID');
        if(!$this->trakt_client_id) {
            throw new \Exception('No API key set');
        }
    }

    private function getOptions() {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'trakt-api-version' => 2,
                'trakt-api-key' => $this->trakt_client_id
            ]
        ];
        $env = getenv('APP_ENV');
        if($env === 'local') {
            $options['verify'] = false;
        }
        return $options;
    }

    public function getStats($user) {
        $endpoint = 'https://api.trakt.tv/users/' . $user . '/stats';

        $client = new Client();

        try{
            $result = $client->get($endpoint, $this->getOptions());
        }
        catch(\Exception $e) {
            throw new \Exception('Invalid request');
        }

        $body = $result->getBody();
        $this->data = json_decode($body, true);

        return $this;
    }

    public function getData($category, $stats_type) {
        if(!isset($this->data[$category]) || !isset($this->data[$category][$stats_type])) {
            throw new \Exception('Invalid category or stats type');
        }

        return $this->data[$category][$stats_type];
    }
}
