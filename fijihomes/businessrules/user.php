<?php
class User{
  public $email;
  public $name;
  public $contact;
  public $address;
  public $password;
  public $status;
  public $type;

  public function __construct(){}

  public function create($email,$name,$contact,$address, $password){
    $this->email = $email;
    $this->name = $name;
    $this->contact = $contact;
    $this->address = $address;
    $this->password= $password;
  }

  /*public function __call($_name, $_arguments){
    $action  = substr($_name, 0, 4);
    $varName = substr($_name, 4);

    if ($action === "set_") $this->{$varName} = $_arguments[0];
    if (isset($this->{$varName})){
        if ($action === "get_") return $this->{$varName};
    }
}

  public function __construct(DALQueryResult $result){
    $this->_fname = $result->Name;
    $this->_gid = $result->G_ID;
    $this->_contact = $result->Contact;
  }*/

  public function __get($var){
    switch ($var){
      case 'email':
        return $this->email;
        break;
      case 'name':
        return $this->name;
        break;
      case 'contact':
        return $this->contact;
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
      case 'email':
        $this->$email=$value;
        break;
      case 'name':
        $this->$name=$value;
        break;
      case 'contact':
        $this->$contact=$value;
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
