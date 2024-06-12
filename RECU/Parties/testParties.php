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

    public function displayAll() {
        foreach ($this->items as $key => $item) {
            echo "Key: $key<br>";
            $item->display();
            echo "<br>";
        }
    }
}

class Party {
    protected $displayName;

    public function __construct($displayName) {
        $this->displayName = $displayName;
    }

    public function getDisplayName() {
        return $this->displayName;
    }

    public function display() {
        echo "Party: DisplayName: {$this->getDisplayName()}<br>";
    }
}

class Person extends Party {
    private $firstName;
    private $lastName;

    public function __construct($displayName, $firstName, $lastName) {
        parent::__construct($displayName);
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function display() {
        parent::display();
        echo "Person: FirstName: {$this->firstName}, LastName: {$this->lastName}<br>";
    }
}

class OrgUnit extends Party {
    private $name;
    private $employees;

    public function __construct($displayName, $name) {
        parent::__construct($displayName);
        $this->name = $name;
        $this->employees = new Collection();
    }

    public function addEmployee(Person $employee, $key) {
        $this->employees->add($employee, $key);
    }

    public function display() {
        parent::display();
        echo "OrgUnit: Name: {$this->name}<br>";
        echo "Employees:<br>";
        $this->employees->displayAll();
    }
}

class Company extends Party {
    private $name;
    private $units;

    public function __construct($displayName, $name) {
        parent::__construct($displayName);
        $this->name = $name;
        $this->units = new Collection();
    }

    public function addUnit(OrgUnit $unit, $key) {
        $this->units->add($unit, $key);
    }

    public function display() {
        parent::display();
        echo "Company: Name: {$this->name}<br>";
        echo "Units:<br>";
        $this->units->displayAll();
    }
}

// Ejemplo de uso
$company = new Company("Company Display Name", "TechCorp");

$orgUnit1 = new OrgUnit("OrgUnit1 Display Name", "Research and Development");
$orgUnit2 = new OrgUnit("OrgUnit2 Display Name", "Marketing");

$employee1 = new Person("Employee1 Display Name", "John", "Doe");
$employee2 = new Person("Employee2 Display Name", "Jane", "Smith");

$orgUnit1->addEmployee($employee1, "E1");
$orgUnit2->addEmployee($employee2, "E2");

$company->addUnit($orgUnit1, "U1");
$company->addUnit($orgUnit2, "U2");

$company->display();

?>
