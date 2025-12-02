<?php 
/* --- Object Oriented Programming -- 
in PHP is often abbreviated to OOP. -
it is a programming paradigm that uses "objects" to design applications and computer programs.

*/

/*
  From PHP5 onwards you can write PHP in either a procedural or object oriented way. 
  OOP consists of classes that can hold "properties" and "methods". Objects can be created from classes.
*/
// 1 Create a simple class[properties and methods]
class student{
    public $name;
    public $age;
    public $laptop;
    public $id;
    // Constructor method is called when an object is instantiated
    // constructor acceppts class properties as arguments
    // it is a special method that is called automatically when an object is created
    // $this is a reference to the current object
    public function __construct($name, $age, $laptop, $id){
        $this->name = $name;
        $this->age = $age;
        $this->laptop = $laptop;
        $this->id = $id;
    }
    public function greeting(){
        return "Hello, my name is $this->name and I am $this->age years old. My laptop is a $this->laptop and my student ID is $this->id.";
    }
}
// 2 Instantiate an object from the class
// new keyword is used to create an object from a class
$student1 = new student("Manu", 21, "Mac", "S1234");
$student2 = new student("TylaAdams", 24, "HP", "S5678");
// 3 Access the properties and methods of the object
echo $student1->name; // Manu
echo "<br>";
echo $student2->laptop; // HP
echo "<br>";
var_dump($student1);
echo "<br>";
var_dump($student2);
echo "<br>";
echo $student1->greeting();
echo "<br>";
echo $student2->greeting();
echo "<br>";

// 4 Create a method that returns a value
class Car {
  public $color;
  public $model;

  public function __construct($color, $model) {
    $this->color = $color;
    $this->model = $model;
  }

  public function message() {
    return "My car is a " . $this->color . " " . $this->model . "!";
  }
}
$myCar = new Car("black", "Subaru");
echo $myCar->message();
echo "<br>";
var_dump($myCar);
echo "<br>";
$myCar2 = new Car("grey", "Volkswagen");
echo $myCar2->message();
echo "<br>";
var_dump($myCar2);

// Create a class
// A class is a blueprint for creating objects.
// A class can contain properties and methods.
// A class is defined using the class keyword followed by the class name and a pair of curly braces.

class User {
  // Properties are just variables that belong to a class.
  // Access Modifiers: public, private, protected
  // public - can be accessed from anywhere
  // private - can only be accessed from inside the class
  // protected - can only be accessed from inside the class and by inheriting classes
  private $name;
  public $email;
  public $password;

  // The constructor is called whenever an object is created from the class.
  // We pass in properties to the constructor from the outside.
  // The constructor is defined using the __construct() method.
  // It is a special method that is called automatically when an object is created.
  // $this is a reference to the current object.
  public function __construct($name, $email, $password) {
    // We assign the properties passed in from the outside to the properties we created inside the class.
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
  }

  // Methods are functions that belong to a class.
  // when a method is called, it is called on an object.
  // Methods are defined using the function keyword followed by the method name and a pair of parentheses
  // They are used to perform actions on the properties of the class.
  // Setter method is used to set the value of a private property.
  // function setName() {
  //   $this->name = $name;
  // }
  /* Getter method is used to get the value of a private property.
   -> if a property is public we access it directly like $user->email
    but if it is private we need to use a getter method to access it like $user->getName()
     We use getter methods to access private properties from outside the class.
     They include the prefix 'get' followed by the property name with the first letter capitalized.
     Most IDEs can auto-generate getter and setter methods for you.

  */

  function getName() {
    return $this->name;
  }

  function login() {
    return "User $this->name is logged in.";
  }

  // Destructor is called when an object is destroyed or the end of the script.
  function __destruct() {
    echo "The user name is {$this->name}.";
  }
}
echo "<br>";
// Instantiate a new user
/*
instantiation is the process of creating an object from a class.
  An object is an instance of a class.
  We create an object from a class using the new keyword followed by the class name and parentheses.
*/
$user1 = new User('Manu', 'Manu@gmail.com', '123456');
$user2 = new User('MLS', 'mls@gmail.com', 'm123456#');
$user3 = new User('Mason', 'mason@gmail.com', 'mase1234');
$user4 = new User('JPM', 'jpm@gmail.com', 'jp12345');

echo "<br>";
echo $user1->getName();
echo "<br>";
echo $user1->login();

// Add a value to a property
// $user1->name = 'manu';
echo "<br>";
var_dump($user1);
// echo $user1->name;
echo '<br>';
$user2 = new User('Tervernier','terver@gmail.com','654321');
echo "<br>";
echo $user2->getName();
echo "<br>";
echo $user2->email;
echo "<br>";
echo $user2->login();
echo "<br>";
var_dump($user2);
echo "<br>";

/* ----------- Inheritence ---------- */

/*
  Inheritence is the ability to create a new class from an existing class.
  It is achieved by creating a new class that extends an existing class.
*/
echo "<br>";
class employee extends User {
  public function __construct($name, $email, $password, $title) {
    parent::__construct($name, $email, $password);
    $this->title = $title;
  }

  public function getTitle() {
    return $this->title;
  }
}
echo "<br>";
$employee1 = new employee('John','johndoe@gmail.com','123456','Manager');
echo $employee1->getTitle();