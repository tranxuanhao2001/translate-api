<?php
namespace TranslateApi;

class ResponseObject {
    public $status;
    public $data;
    public $message;

    public function __construct($status, $data, $message) {
        $this->status = $status;
        $this->data = $data;
        $this->message = $message;
    }
}