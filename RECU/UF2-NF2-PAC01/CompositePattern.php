<?php

abstract class AbstractInstrument{

    private $name;
    private $category;
    private $instruments = array ();

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setCategory($category){
        $this->category = $category;
    }

    public function getCategory(){
        return $this->category;
    }

    public function add(AbstractInstrument $instrument){
        array_push($this->instruments, $instrument);
    }

    public function hasChildren(){
        return (bool) (count($this->instruments) > 0);
    }

    public function getDescription(){
        echo "- Instrumento Principal ". $this->getName();
        if ($this->hasChildren()){
            echo " incluye:<br>";
            foreach($this->instruments as $instrument){
                echo " - ";
                $instrument->getDescription();

            }
        }
    }
}

class DrumSet extends AbstractInstrument{

    function __construct($name){ 
            parent::setName($name);
            parent::setCategory("Bateria");
    }

}

class BaseDrum extends AbstractInstrument{

    function __construct($name){ 
            parent::setName($name);
            parent::setCategory("Tambor");
    }

}

class LateralDrum extends AbstractInstrument{

    function __construct($name){ 
            parent::setName($name);
            parent::setCategory("Bateria");
    }

}

class Guitar extends AbstractInstrument{

    function __construct($name){ 
            parent::setName($name);
            parent::setCategory("Guitarra");
    }

}

class Plato extends AbstractInstrument {

    function __construct($name){ 
        parent::setName($name);
        parent::setCategory("Plato");
    }

}


$drums = new DrumSet("Bateria Pro");
$drums->add(new BaseDrum("Tambor Basica"));
$drums->add(new LateralDrum("Tambor Lateral"));

$platos = new Plato("Platos Conjunto");
$platos->add(new Plato("Plato A"));
$platos->add(new Plato("Plato B"));

$drums->add($platos);

$guitar = new Guitar("Guitarra clasica");

echo "Lista de instrumentos<br>";
$drums->getDescription();
$guitar->getDescription();