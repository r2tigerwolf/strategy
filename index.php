<?php
    interface OutputInterface
    {
        public function load($fruitArray);
    }
    
    class ArrayOutput implements OutputInterface
    {
        public function load($fruitArray)
        {   
            return $fruitArray;
        }
    }
    
    class JsonOutput implements OutputInterface
    {
        public function load($fruitArray)
        {
            return json_encode($fruitArray);
        }
    }
    
    class SerializedOutput implements OutputInterface
    {
        public function load($fruitArray)
        {
            return serialize($fruitArray);
        }
    }
    
    class ClientClass
    {
        private $output;
        
        public function setOutput(OutputInterface $outputType)
        {
            $this->output = $outputType;
        }
        
        public function loadOutput($fruitArray)
        {
            return $this->output->load($fruitArray);
        }
    }

    $fruitArray = array("fruit1" => "Apple", "fruit2" => "Orange", "fruit3" => "Grapes", "fruit4" => "Kiwi");

    $client = new ClientClass();

    // Array
    $client->setOutput(new ArrayOutput());
    $data = $client->loadOutput($fruitArray);
    var_dump($data);

    echo "<br/>";
    
    // JSON
    $client->setOutput(new JsonOutput());
    $data = $client->loadOutput($fruitArray);
    var_dump($data);
    
    /*
        Output:
        
        array(4) { ["fruit1"]=> string(5) "Apple" ["fruit2"]=> string(6) "Orange" ["fruit3"]=> string(6) "Grapes" ["fruit4"]=> string(4) "Kiwi" } 
        string(70) "{"fruit1":"Apple","fruit2":"Orange","fruit3":"Grapes","fruit4":"Kiwi"}"
    */
?>