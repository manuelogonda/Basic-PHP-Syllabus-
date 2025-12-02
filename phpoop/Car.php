<?
class Car{
    //properties
    protected $brand;
    protected $color;
    protected $vehicleType = "car";

    //constructor
    public function __construct($param1,$param2)
    {
        //Reffering to properties of the class
        $this->brand = $param1;
        $this->color = $param2;
        throw new \Exception('Not implemented');
    }
    //Getter and setter Methods
    public function getBrand(){
        return $this->brand;
    }
    public function setBrand($brand){
        return $this->brand = $brand;
    }
    // class Method
    public function getCarInfo(){
        return "Brand" . $this->brand . ",Color" . $this->color; 
    }
}
//Now objects
$car01 = new Car("Mercedes","White");
$car02 = new Car("Subaru","Black");
$car03 = new Car("Fortune","Grey");
