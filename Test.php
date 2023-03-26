<?php


class Test {
    protected $var;

    function fill(string $input): void{
      $this->var = $input;
    }

    function show(): void{
      echo $this->var;
    }

  }


$new = new Test();
$new->fill('ghello');
$new->show();