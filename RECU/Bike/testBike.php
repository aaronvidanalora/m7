<?php

class Collection {
    private $items = [];

    public function add($item, $key) {
        if (isset($this->items[$key])) {
            throw new Exception("Key $key already in use.");
        }
        $this->items[$key] = $item;
    }

    public function get($key) {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        } else {
            throw new Exception("Invalid key $key.");
        }
    }

    public function getAll() {
        return $this->items;
    }

    public function displayAll() {
        foreach ($this->items as $key => $item) {
            echo "Key: $key<br>";
            $item->print();
            echo "<br>";
        }
    }
}

class Bike {
    protected $id;
    protected $name;
    protected $gears;

    public function __construct($id = '', $name = '', $gears = 0) {
        $this->id = $id;
        $this->name = $name;
        $this->gears = $gears;
    }

    public function getID() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getGears() {
        return $this->gears;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setGears($gears) {
        $this->gears = $gears;
    }

    public function print() {
        echo "Bike: ID: {$this->getID()}, Name: {$this->getName()}, Gears: {$this->getGears()}<br>";
    }

    public function read($data) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->gears = $data['gears'];
    }
}

class Delivery extends Bike {
    private $capacity;

    public function __construct($id = '', $name = '', $gears = 0, $capacity = 0) {
        parent::__construct($id, $name, $gears);
        $this->capacity = $capacity;
    }

    public function getCapacity() {
        return $this->capacity;
    }

    public function setCapacity($capacity) {
        $this->capacity = $capacity;
    }

    public function print() {
        parent::print();
        echo "Delivery: Capacity: {$this->getCapacity()}<br>";
    }

    public function read($data) {
        parent::read($data);
        $this->capacity = $data['capacity'];
    }
}

class Urban extends Bike {

    public function __construct($id = '', $name = '', $gears = 0) {
        parent::__construct($id, $name, $gears);
    }

    public function print() {
        parent::print();
        echo "Urban Bike<br>";
    }

    public function read($data) {
        parent::read($data);
    }
}

class Bikes {
    private $bikes;

    public function __construct() {
        $this->bikes = new Collection();
    }

    public function addBike(Bike $bike, $key) {
        $this->bikes->add($bike, $key);
    }

    public function getTotalCapacity() {
        $totalCapacity = 0;
        foreach ($this->bikes->getAll() as $bike) {
            if ($bike instanceof Delivery) {
                $totalCapacity += $bike->getCapacity();
            }
        }
        return $totalCapacity;
    }

    public function getTotalGears() {
        $totalGears = 0;
        foreach ($this->bikes->getAll() as $bike) {
            $totalGears += $bike->getGears();
        }
        return $totalGears;
    }

    public function print() {
        $this->bikes->displayAll();
    }

    public function read($data) {
        foreach ($data as $key => $bikeData) {
            if ($bikeData['type'] === 'Delivery') {
                $bike = new Delivery();
            } else {
                $bike = new Urban();
            }
            $bike->read($bikeData);
            $this->addBike($bike, $key);
        }
    }
}

class BikeFactory {
    public static function make($data) {
        if ($data['type'] === 'Delivery') {
            return new Delivery($data['id'], $data['name'], $data['gears'], $data['capacity']);
        } else {
            return new Urban($data['id'], $data['name'], $data['gears']);
        }
    }
}

// Ejemplo de uso
$bikes = new Bikes();

$data1 = ['type' => 'Delivery', 'id' => 'D1', 'name' => 'Delivery Bike 1', 'gears' => 5, 'capacity' => 10];
$data2 = ['type' => 'Urban', 'id' => 'U1', 'name' => 'Urban Bike 1', 'gears' => 3];

$bike1 = BikeFactory::make($data1);
$bike2 = BikeFactory::make($data2);

$bikes->addBike($bike1, "B1");
$bikes->addBike($bike2, "B2");

$bikes->print();
echo "Total Capacity: " . $bikes->getTotalCapacity() . "<br>";
echo "Total Gears: " . $bikes->getTotalGears() . "<br>";

?>
