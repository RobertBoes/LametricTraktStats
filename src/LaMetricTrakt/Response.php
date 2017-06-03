<?php

namespace RobertBoes\LaMetricTrakt;


class Response
{
    public function data($result, $category) {
        return $this->asJson([
            'frames' => [
                [
                    'index' => 0,
                    'text' => $result,
                    'icon'  => $this->getIcon($category)
                ]
            ]
        ]);
    }

    public function getIcon($category) {
        switch ($category) {
            case Category::MOVIES:
                return 'i7862';
            case Category::EPISODES:
                return 'i2649';
            default:
                return 'i10701';
        }
    }

    public function error($message = 'Error') {
        return $this->asJson([
            'frames' => [
                [
                    'index' => 0,
                    'text' => $message,
                    'icon'  => 'i10701'
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
