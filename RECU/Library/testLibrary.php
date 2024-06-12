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
        }
    }
}

class Author {
    private $name;
    private $biography;
    private $birthDate;

    public function __construct($name, $biography, $birthDate) {
        $this->setName($name);
        $this->setBiography($biography);
        $this->setBirthDate($birthDate);
    }

    public function setName($name) { $this->name = $name; }
    public function setBiography($biography) { $this->biography = $biography; }
    public function setBirthDate($birthDate) { $this->birthDate = $birthDate; }

    public function getName() { return $this->name; }
    public function getBiography() { return $this->biography; }
    public function getBirthDate() { return $this->birthDate; }

    public function display() {
        echo "Author: {$this->getName()}, Biography: {$this->getBiography()}, Birth Date: {$this->getBirthDate()}<br>";
    }
}

class Book {
    protected $ISBN;
    protected $name;
    protected $subject;
    protected $overview;
    protected $publisher;
    protected $publicationDate;
    protected $lang;
    protected $authors = [];

    public function __construct($ISBN, $name, $subject, $overview, $publisher, $publicationDate, $lang) {
        $this->setISBN($ISBN);
        $this->setName($name);
        $this->setSubject($subject);
        $this->setOverview($overview);
        $this->setPublisher($publisher);
        $this->setPublicationDate($publicationDate);
        $this->setLang($lang);
    }

    public function setISBN($ISBN) { $this->ISBN = $ISBN; }
    public function setName($name) { $this->name = $name; }
    public function setSubject($subject) { $this->subject = $subject; }
    public function setOverview($overview) { $this->overview = $overview; }
    public function setPublisher($publisher) { $this->publisher = $publisher; }
    public function setPublicationDate($publicationDate) { $this->publicationDate = $publicationDate; }
    public function setLang($lang) { $this->lang = $lang; }

    public function getISBN() { return $this->ISBN; }
    public function getName() { return $this->name; }
    public function getSubject() { return $this->subject; }
    public function getOverview() { return $this->overview; }
    public function getPublisher() { return $this->publisher; }
    public function getPublicationDate() { return $this->publicationDate; }
    public function getLang() { return $this->lang; }

    public function addAuthor(Author $author) {
        $this->authors[] = $author;
    }

    public function getAuthors() { return $this->authors; }

    public function display() {
        echo "Book: ISBN: {$this->getISBN()}, Name: {$this->getName()}, Subject: {$this->getSubject()}, Overview: {$this->getOverview()}, Publisher: {$this->getPublisher()}, Publication Date: {$this->getPublicationDate()}, Language: {$this->getLang()}<br>";
        foreach ($this->getAuthors() as $author) {
            $author->display();
        }
    }
}

class BookItem extends Book {
    private $barcode;
    private $tag;
    private $title;
    private $isReferenceOnly;
    private $numberOfPages;
    private $format;
    private $borrowed;
    private $loanPeriod;
    private $dueDate;
    private $isOverdue;

    public function __construct($ISBN, $name, $subject, $overview, $publisher, $publicationDate, $lang, $barcode, $tag, $title, $isReferenceOnly, $numberOfPages, $format, $borrowed, $loanPeriod, $dueDate, $isOverdue) {
        parent::__construct($ISBN, $name, $subject, $overview, $publisher, $publicationDate, $lang);
        $this->setBarcode($barcode);
        $this->setTag($tag);
        $this->setTitle($title);
        $this->setIsReferenceOnly($isReferenceOnly);
        $this->setNumberOfPages($numberOfPages);
        $this->setFormat($format);
        $this->setBorrowed($borrowed);
        $this->setLoanPeriod($loanPeriod);
        $this->setDueDate($dueDate);
        $this->setIsOverdue($isOverdue);
    }

    public function setBarcode($barcode) { $this->barcode = $barcode; }
    public function setTag($tag) { $this->tag = $tag; }
    public function setTitle($title) { $this->title = $title; }
    public function setIsReferenceOnly($isReferenceOnly) { $this->isReferenceOnly = $isReferenceOnly; }
    public function setNumberOfPages($numberOfPages) { $this->numberOfPages = $numberOfPages; }
    public function setFormat($format) { $this->format = $format; }
    public function setBorrowed($borrowed) { $this->borrowed = $borrowed; }
    public function setLoanPeriod($loanPeriod) { $this->loanPeriod = $loanPeriod; }
    public function setDueDate($dueDate) { $this->dueDate = $dueDate; }
    public function setIsOverdue($isOverdue) { $this->isOverdue = $isOverdue; }

    public function getBarcode() { return $this->barcode; }
    public function getTag() { return $this->tag; }
    public function getTitle() { return $this->title; }
    public function getIsReferenceOnly() { return $this->isReferenceOnly; }
    public function getNumberOfPages() { return $this->numberOfPages; }
    public function getFormat() { return $this->format; }
    public function getBorrowed() { return $this->borrowed; }
    public function getLoanPeriod() { return $this->loanPeriod; }
    public function getDueDate() { return $this->dueDate; }
    public function getIsOverdue() { return $this->isOverdue; }

    public function display() {
        parent::display();
        echo "Title: {$this->getTitle()}, Barcode: {$this->getBarcode()}, Tag: {$this->getTag()}, Is Reference Only: {$this->getIsReferenceOnly()}, Number of Pages: {$this->getNumberOfPages()}, Format: {$this->getFormat()}, Borrowed: {$this->getBorrowed()}, Loan Period: {$this->getLoanPeriod()}, Due Date: {$this->getDueDate()}, Is Overdue: {$this->getIsOverdue()}<br>";
    }
}

class Account {
    private $number;
    private $history;
    private $opened;
    private $state;

    public function __construct($number, $history, $opened, $state) {
        $this->setNumber($number);
        $this->setHistory($history);
        $this->setOpened($opened);
        $this->setState($state);
    }

    public function setNumber($number) { $this->number = $number; }
    public function setHistory($history) { $this->history = $history; }
    public function setOpened($opened) { $this->opened = $opened; }
    public function setState($state) { $this->state = $state; }

    public function getNumber() { return $this->number; }
    public function getHistory() { return $this->history; }
    public function getOpened() { return $this->opened; }
    public function getState() { return $this->state; }

    public function display() {
        echo "Account Number: {$this->getNumber()}, History: {$this->getHistory()}, Opened: {$this->getOpened()}, State: {$this->getState()}<br>";
    }
}

class Library {
    private $name;
    private $address;
    private $colBookItem;
    private $colAccount;

    public function __construct($name, $address) {
        $this->setName($name);
        $this->setAddress($address);
        $this->colBookItem = new Collection();
        $this->colAccount = new Collection();
    }

    public function setName($name) { $this->name = $name; }
    public function setAddress($address) { $this->address = $address; }

    public function getName() { return $this->name; }
    public function getAddress() { return $this->address; }

    public function addBookItem(BookItem $bookItem, $key) {
        $this->colBookItem->add($bookItem, $key);
    }

    public function addAccount(Account $account, $key) {
        $this->colAccount->add($account, $key);
    }

    public function display() {
        echo "Library: {$this->getName()}, Address: {$this->getAddress()}<br>";
        echo "Book Items:<br>";
        $this->colBookItem->displayAll();
        echo "Accounts:<br>";
        $this->colAccount->displayAll();
    }
}

// Create objects and use them
$library = new Library("Central Library", "123 Main St");

// Create BookItems
$bookItem1 = new BookItem("978-3-16-148410-0", "Introduction to Algorithms", "Education", "A comprehensive textbook on algorithms.", "MIT Press", "2020-08-01", "English", "BC001", "TAG001", "Intro Algo", false, 1312, "Hardcover", null, null, null, false);
$bookItem2 = new BookItem("978-0-262-03384-8", "Artificial Intelligence: A Modern Approach", "Education", "A modern approach to artificial intelligence.", "Pearson", "2020-12-01", "English", "BC002", "TAG002", "AI Modern", true, 1152, "Paperback", null, null, null, false);

// Create Accounts
$account1 = new Account("001", "No issues", "2021-01-10", "Active");
$account2 = new Account("002", "Late returns", "2021-02-15", "Suspended");

// Add items to collections in the library
$library->addBookItem($bookItem1, "B1");
$library->addBookItem($bookItem2, "B2");
$library->addAccount($account1, "A1");
$library->addAccount($account2, "A2");

// Display library information
$library->display();

$author1 = new Author("Alice Munro", "Canadian short story writer", "1931-07-10");
$author2 = new Author("Margaret Atwood", "Canadian poet, novelist, literary critic", "1939-11-18");

$book1 = new Book("978-0143121076", "Dear Life", "Fiction", "Short stories about the details of life.", "Penguin Books", "2012-11-13", "English");
$book1->addAuthor($author1);

$book2 = new Book("978-0385543781", "The Testaments", "Fiction", "A sequel to The Handmaid's Tale.", "Nan A. Talese", "2019-09-10", "English");
$book2->addAuthor($author2);

// Display books with their authors
$book1->display();
$book2->display();

?>