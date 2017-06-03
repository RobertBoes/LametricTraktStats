<?php

namespace RobertBoes\LaMetricTrakt;


class Response
{
    public function data($result) {
        return $this->asJson([
            'frames' => [
                [
                    'index' => 0,
                    'text' => $result,
                    'icon'  => 'i6574'
                ]
            ]
        ]);
    }

    public function error($message = 'Error') {
        return $this->asJson([
            'frames' => [
                [
                    'index' => 0,
                    'text' => $message,
                    'icon'  => 'i6574'
                ]
            ]
        ]);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function asJson($data = array())
    {
        header("Content-Type: application/json");
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}
