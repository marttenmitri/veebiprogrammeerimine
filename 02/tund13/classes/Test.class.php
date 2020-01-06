<?php
    class Test {
        //muutujad
        private $secretNumber;
        public $knownNumber;

        //funktsioonid ehk methods
        //constructor ehk meetod mis käivitub üks kord, klassi kasutamiselevõtmisel
        function __construct($sentNumber){
            $this->secretNumber = 3;
            $this->knownNumber = $sentNumber;
            echo "salajane: " .$this->secretNumber. " ja teadaolev: ".$this->knownNumber;
            $this->addNumbers();
        }//construct lõppeb
        function __destruct(){
            echo "klass lõpetab";
        }
        private function addNumbers(){
            $sum = $this->secretNumber +  $this->knownNumber;
            echo "summa on ". $sum;
        }

        public function multiplyNumbers(){
            $result = $this->secretNumber *  $this->knownNumber;
            echo "korrutis on ". $result;
        }
    }//class loppeb