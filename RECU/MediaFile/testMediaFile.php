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

class MediaItem {
    protected $name;
    protected $thumbnail;

    public function __construct($name, $thumbnail) {
        $this->setName($name);
        $this->setThumbnail($thumbnail);
    }

    public function setName($name) { $this->name = $name; }
    public function setThumbnail($thumbnail) { $this->thumbnail = $thumbnail; }

    public function getName() { return $this->name; }
    public function getThumbnail() { return $this->thumbnail; }

    public function display() {
        echo "MediaItem: Name: {$this->getName()}, Thumbnail: {$this->getThumbnail()}<br>";
    }
}

class MediaFile extends MediaItem {
    protected $fileName;
    protected $size;

    public function __construct($name, $thumbnail, $fileName, $size) {
        parent::__construct($name, $thumbnail);
        $this->setFileName($fileName);
        $this->setSize($size);
    }

    public function setFileName($fileName) { $this->fileName = $fileName; }
    public function setSize($size) { $this->size = $size; }

    public function getFileName() { return $this->fileName; }
    public function getSize() { return $this->size; }

    public function display() {
        parent::display();
        echo "MediaFile: FileName: {$this->getFileName()}, Size: {$this->getSize()}<br>";
    }
}

class Photo extends MediaFile {
    public function __construct($name, $thumbnail, $fileName, $size) {
        parent::__construct($name, $thumbnail, $fileName, $size);
    }

    public function display() {
        echo "Photo:<br>";
        parent::display();
    }
}

class Video extends MediaFile {
    public function __construct($name, $thumbnail, $fileName, $size) {
        parent::__construct($name, $thumbnail, $fileName, $size);
    }

    public function display() {
        echo "Video:<br>";
        parent::display();
    }
}

class MediaFolder {
    private $items;
    private $name;

    public function __construct($name) {
        $this->name = $name;
        $this->items = new Collection();
    }

    public function addItem(MediaItem $item, $key) {
        $this->items->add($item, $key);
    }

    public function display() {
        echo "MediaFolder: Name: {$this->name}<br><br>";
        $this->items->displayAll();
    }
}

// Crear objetos y usarlos
$mediaFolder = new MediaFolder("My Media Collection");

// Crear Photo y Video
$photo1 = new Photo("Photo 1", "photo1_thumb.jpg", "photo1.jpg", 1024);
$photo2 = new Photo("Photo 2", "photo2_thumb.jpg", "photo2.jpg", 2048);
$video1 = new Video("Video 1", "video1_thumb.jpg", "video1.mp4", 4096);
$video2 = new Video("Video 2", "video2_thumb.jpg", "video2.mp4", 8192);

// Añadir los items a la carpeta
$mediaFolder->addItem($photo1, "P1");
$mediaFolder->addItem($photo2, "P2");
$mediaFolder->addItem($video1, "V1");
$mediaFolder->addItem($video2, "V2");

// Mostrar la información de la carpeta y sus elementos
$mediaFolder->display();

?>
