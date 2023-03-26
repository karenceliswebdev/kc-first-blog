<?php

include_once('Test.php');

class Klad extends Test {

  private $greeting = 'hi';

  public function show() {
    echo $this->var; //krijg db
    echo $this->greeting;
  }
  
}

$test = new Klad();
$test->show();


/*
class KLADTWO {
    protected $var ='db';

  }

class KLAD extends KLADTWO {

  private $greeting = 'hi';

  public function show() {
    echo $greeting;
  }
  
}

$test = new KLAD();
$test->show();

deze error:

 Undefined variable $greeting
*/

//$this->greeting = 'hi'; zo alleen niet in functie is fout