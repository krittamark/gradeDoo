<?php
class Data {
    private $name;
    private $viewState;
    private $eventValidation;

    protected function __construct(string $term) {
        $file = __DIR__ . '/../data/' . $term . '.json';
        if (file_exists($file)) {
            $json = file_get_contents($file);
            $json = json_decode($json, true);
            $this->name = $json['name'];
            $this->viewState = $json['data']['VIEWSTATE'];
            $this->eventValidation = $json['data']['EVENTVALIDATION'];
        }
    }

    protected function getName() {
        return $this->name;
    }

    protected function getViewState() {
        return $this->viewState;
    }

    protected function getEventValidation() {
        return $this->eventValidation;
    }
}