<?php
    class Result # extends AnotherClass implements Interface
    {
        public $success;
        public $result;
        public $answer;
        public $message;
        
        public function __construct() {
            $this->success = false;
            $this->result = [];
            $this->answer = [];
            $this->message = '';
        }
    }
    
