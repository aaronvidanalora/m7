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
            echo "<br>"; // Añadir salto de línea después de cada item
        }
    }
}

class Task {
    protected $title;
    protected $date;
    protected $dueDate;
    protected $assignedTo;
    protected $description;

    public function __construct($title, $date, $dueDate, $assignedTo, $description) {
        $this->setTitle($title);
        $this->setDate($date);
        $this->setDueDate($dueDate);
        $this->setAssignedTo($assignedTo);
        $this->setDescription($description);
    }

    public function setTitle($title) { $this->title = $title; }
    public function setDate($date) { $this->date = $date; }
    public function setDueDate($dueDate) { $this->dueDate = $dueDate; }
    public function setAssignedTo($assignedTo) { $this->assignedTo = $assignedTo; }
    public function setDescription($description) { $this->description = $description; }

    public function getTitle() { return $this->title; }
    public function getDate() { return $this->date; }
    public function getDueDate() { return $this->dueDate; }
    public function getAssignedTo() { return $this->assignedTo; }
    public function getDescription() { return $this->description; }

    public function display() {
        echo "Task: Title: {$this->getTitle()}, Date: {$this->getDate()}, DueDate: {$this->getDueDate()}, AssignedTo: {$this->getAssignedTo()}, Description: {$this->getDescription()}<br>";
    }
}

class FixedBudgetTask extends Task {
    protected $budget;
    protected $childTasks;

    public function __construct($title, $date, $dueDate, $assignedTo, $description, $budget) {
        parent::__construct($title, $date, $dueDate, $assignedTo, $description);
        $this->budget = $budget;
        $this->childTasks = new Collection();
    }

    public function addChildTask(Task $task, $key) {
        $this->childTasks->add($task, $key);
    }

    public function display() {
        parent::display();
        echo "FixedBudgetTask: Budget: {$this->budget}<br>";
        echo "Child Tasks:<br>";
        $this->childTasks->displayAll();
    }
}

class TimeBasedTask extends Task {
    protected $estimatedHours;
    protected $hoursSpent;
    protected $childTasks;

    public function __construct($title, $date, $dueDate, $assignedTo, $description, $estimatedHours, $hoursSpent) {
        parent::__construct($title, $date, $dueDate, $assignedTo, $description);
        $this->estimatedHours = $estimatedHours;
        $this->hoursSpent = $hoursSpent;
        $this->childTasks = new Collection();
    }

    public function addChildTask(Task $task, $key) {
        $this->childTasks->add($task, $key);
    }

    public function display() {
        parent::display();
        echo "TimeBasedTask: EstimatedHours: {$this->estimatedHours}, HoursSpent: {$this->hoursSpent}<br>";
        echo "Child Tasks:<br>";
        $this->childTasks->displayAll();
    }
}

class Project {
    private $budget;
    private $workItems;
    private $name;

    public function __construct($name, $budget) {
        $this->name = $name;
        $this->budget = $budget;
        $this->workItems = new Collection();
    }

    public function addWorkItem(Task $task, $key) {
        $this->workItems->add($task, $key);
    }

    public function display() {
        echo "Project: Name: {$this->name}, Budget: {$this->budget}<br>";
        echo "Work Items:<br>";
        $this->workItems->displayAll();
    }
}

// Crear objetos y usarlos
$project = new Project("New Project", 10000);

// Crear FixedBudgetTask y TimeBasedTask
$fixedTask1 = new FixedBudgetTask("Fixed Task 1", "2023-01-01", "2023-02-01", "John Doe", "Description 1", 5000);
$fixedTask2 = new FixedBudgetTask("Fixed Task 2", "2023-03-01", "2023-04-01", "Jane Doe", "Description 2", 3000);
$timeTask1 = new TimeBasedTask("Time Task 1", "2023-05-01", "2023-06-01", "Jim Doe", "Description 3", 100, 50);
$timeTask2 = new TimeBasedTask("Time Task 2", "2023-07-01", "2023-08-01", "Janet Doe", "Description 4", 200, 150);

// Añadir tareas hijas a las tareas de presupuesto fijo y basadas en tiempo
$childTask1 = new Task("Child Task 1", "2023-01-05", "2023-01-15", "Jack Doe", "Child Description 1");
$childTask2 = new Task("Child Task 2", "2023-03-05", "2023-03-15", "Jill Doe", "Child Description 2");
$fixedTask1->addChildTask($childTask1, "C1");
$timeTask1->addChildTask($childTask2, "C2");

// Añadir las tareas al proyecto
$project->addWorkItem($fixedTask1, "F1");
$project->addWorkItem($fixedTask2, "F2");
$project->addWorkItem($timeTask1, "T1");
$project->addWorkItem($timeTask2, "T2");

// Mostrar la información del proyecto y sus elementos
$project->display();

?>
