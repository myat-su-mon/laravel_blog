<?php

namespace App;

class Test{
    protected $name;

    public function __construct($name) {
        $this->name = $name;
    }

    protected function execute() {
        dd('execution works');
    }
}
