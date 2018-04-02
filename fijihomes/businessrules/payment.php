<?php
class Payment{
  public $tenantid;
  public $plotid;
  public $payamount;
  public $employeeid;
  public $comamount;
  public $bondamount;
  //public $type;

  public function __construct(){}

  public function create($tenantid,$plotid,$payamount){
    $this->tenantid = $tenantid;
    $this->plotid = $plotid;
    $this->payamount = $payamount;
  }

  public function __get($var){
    switch ($var){
      case 'tenantid':
        return $this->tenantid;
        break;
      case 'plotid':
        return $this->plotid;
        break;
      case 'payamount':
        return $this->payamount;
        break;
      case 'address':
        return $this->address;
        break;
      case 'password':
        return $this->password;
        break;
      default:
        return null;
        break;
    }
  }

  public function __set($var,$value){
    switch ($var){
      case 'tenantid':
        $this->$tenantid=$value;
        break;
      case 'plotid':
        $this->$plotid=$value;
        break;
      case 'payamount':
        $this->$payamount=$value;
        break;
      case 'address':
        $this->$address=$value;
        break;
      case 'password':
        $this->$password=$value;
        break;
      case 'status':
        $this->$status= $value;
        break;
      case 'type':
        $this->$type= $value;
        break;
      default:
        return null;
        break;
    }
  }

  public function addowner(){
    $dal = new DAL();
    $res = $dal->addowner($this);
  }

  public function addtenant(){
    $dal = new DAL();
    $res = $dal->addtenant($this);
  }

  public function addaccess(){
    $dal = new DAL();
    $res = $dal->adduseraccess($this);
  }
  public function addgenuineowner($gid,$ownerid){
    $dal = new DAL();
    $res= $dal->addgenuineowner($gid,$ownerid);
  }
  /*public function giveaccess(){
    $dal =new DAL();
    $res = $dal->login($this->email);
    if($res){
        $row = $res;
        $this->password = $row[0]->Password;
        $this->type = $row[0]->Type;
        return $this;
    }
    else{return NULL;}
  }*/
}
?>
