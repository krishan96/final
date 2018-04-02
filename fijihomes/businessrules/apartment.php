<?php
class Apartment{
  private $address;
  private $area;
  private $rooms;
  private $price;
  private $amenities;
  private $images;
  private $available;
  private $owner;
  private $opendatetime;

  public function __construct(){}

  public function create($a,$b,$c,$d,$e,$f,$h){
    $this->address = $a;
    $this->area = $b;
    $this->rooms = $c;
    $this->price = $d;
    $this->amenities= $e;
    $this->images= $f;
    //$this->available= $g;
    $this->owner= $h;
  }

  public function __get($var){
    switch ($var){
      case 'address':
        return $this->address;
        break;
      case 'area':
        return $this->area;
        break;
      case 'rooms':
        return $this->rooms;
        break;
      case 'price':
        return $this->price;
        break;
      case 'amenities':
        return $this->amenities;
        break;
      case 'images':
        return $this->images;
        break;
      case 'available':
        return $this->available;
        break;
      case 'owner':
        return $this->owner;
        break;
      default:
        return null;
        break;
    }
  }

  public function __set($var,$value){
    switch ($var){
      /*case 'email':
        $this->$_email=$value;
        break;
      case 'name':
        $this->$_name=$value;
        break;
      case 'contact':
        $this->$_contact=$value;
        break;
      case 'address':
        $this->$_address=$value;
        break;
      case 'password':
        $this->$_password=$value;
        break;*/
      case 'available':
        $this->$available= $value;
        break;
      case 'opendatetime':
        $this->$opendatetime= $value;
        break;
      default:
        return null;
        break;
    }
  }
  public function addapartment(){
    $dal = new DAL();
    $res = $dal->addapartment($this);
  }

}
?>
