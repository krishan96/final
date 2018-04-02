<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/fijihomes/businessrules/user.php');
require_once($_SERVER['DOCUMENT_ROOT'] .'/fijihomes/businessrules/apartment.php');
require_once($_SERVER['DOCUMENT_ROOT'] .'/fijihomes/businessrules/payment.php');

class DALQueryResult {
  private $_results = array();

  public function __construct(){}

  public function __set($var,$val){
	$this->_results[$var] = $val;
  }

  public function __get($var){
	if (isset($this->_results[$var])){
	  return $this->_results[$var];
	}
	else{
	  return null;
	}
  }
}

class DAL {

  public function __construct(){}

  public function get_models_by_make_name($name){
    $sql = "SELECT models.id as id, models.name as name, makes.name as make FROM models INNER JOIN makes ON models.make=makes.id WHERE makes.name='$name'";
    return $this->query($sql);
  }

  public function adduseraccess(User $user)
  {
    $query = "INSERT INTO access (Email, Password, Status, Type) VALUES ('$user->email', '$user->password', '$user->status', '$user->type')";
    return $this->query($query);
  }

  public function addowner(User $owner)
  {
    $query = "INSERT INTO owner (Name, Contact, Address, Email) VALUES ('$owner->name', '$owner->contact', '$owner->address', '$owner->email')";
    return $this->query($query);
  }

  public function addtenant(User $tenant)
  {
    $query = "INSERT INTO tenant (Name, Contact,Address,Email) VALUES ('$tenant->name', '$tenant->contact', '$tenant->address', '$tenant->email')";
    return $this->query($query);
  }
  public function addgenuineowner($gid,$ownerid){
    $query = "UPDATE owner SET G_ID = '$gid' where Owner_ID = '$ownerid'";
    return $this->query($query);
  }
  public function addapartment(Apartment $apart){
  $query = "INSERT INTO apartments (Address,Area, Rooms, Price, Amenities, Images,Owner_ID) VALUES
  ('$apart->address','$apart->area','$apart->rooms','$apart->price','$apart->amenities','$apart->images',$apart->owner)";
  return $this->query($query);
  }
  public function login($a){
    $query = "SELECT* FROM access WHERE Email = '$a'";
    return $this->query($query);
  }
  public function addpayment($a,$b,$c)  {
    $query = "INSERT INTO payment (Tenant_ID, Plot,Amount,PayDatetime) VALUES ('$a','$b','$c',NOW())";
    return $this->query($query);
  }
  public function sold($id)  {
    $query = "UPDATE apartments SET Available=0 WHERE Plot = '$id'";
    return $this->query($query);
  }

  public function addcommission($b,$d)  {
    $c = $d/10;
    $query = "INSERT INTO commission (Pay_ID, Employee_ID,Com_Amount) VALUES ((SELECT Pay_ID FROM payment ORDER BY Pay_ID DESC LIMIT 1),(SELECT Employee_ID FROM allocation where Owner_ID =(SELECT Owner_ID FROM apartments where Plot = '$b')),'$c');";
    return $this->query($query);
  }
  public function addbond($b)  {
    $query = "INSERT INTO bond (Pay_ID, Bond_Amount) VALUES ((SELECT Pay_ID FROM payment ORDER BY Pay_ID DESC LIMIT 1),'$b')";
    return $this->query($query);
  }
  public function comagent(){
    $query = "SELECT commission.Employee_ID as id,commission.Pay_ID as payid ,commission.Com_Amount as amount,employee.E_Name as name FROM commission INNER JOIN
    employee ON commission.Employee_ID = employee.Employee_ID";
    return $this->query($query);
  }
  public function comagentid($id){
    $query = "SELECT commission.Employee_ID as id,commission.Pay_ID as payid, commission.Com_Amount as amount,employee.E_Name as name FROM commission INNER JOIN
    employee ON commission.Employee_ID = employee.Employee_ID WHERE commission.Employee_ID = '$id' OR employee.E_Name LIKE '%$id%'";
    return $this->query($query);
  }
  public function comdetail($a){
    $sql = "SELECT * FROM apartments WHERE Plot=(SELECT Plot FROM payment WHERE Pay_ID = '$a')";
    return $this->query($sql);//
  }
  public function paydetail(){
    $sql = "SELECT * FROM payment ORDER BY PayDateTime DESC;";
    return $this->query($sql);//
  }
  public function allopenhouse() {
   $query = "SELECT * FROM apartments WHERE OHDateTime IS NOT NULL ORDER BY OHDateTime ASC;";
   return $this->query($query);
 }
 public function assignplottotenant($a,$b){
   $query = "UPDATE tenant SET Plot ='$a' WHERE Tenant_ID = '$b'";
   return $this->query($query);
 }


  //openhouse.php functions
public function searchhouse($value)
  {
    $query = "SELECT apartments.Plot, apartments.Address, owner.Name
      FROM apartments
      INNER JOIN owner ON apartments.Owner_ID=owner.Owner_ID WHERE (apartments.OHDateTime IS NULL) AND (apartments.Address LIKE '%$value%' OR owner.Name LIKE '%$value%')";
    return $this->query($query);
  }

  public function displayall(){
		$query = "SELECT apartments.Plot, apartments.Address, owner.Name
    FROM apartments
    INNER JOIN owner ON apartments.Owner_ID=owner.Owner_ID WHERE apartments.OHDateTime IS NULL";# OR (apartments.OHTime IS NULL)
		return $this->query($query);
	}

  public function addopenhouse($time, $id)
  {
    $query = "UPDATE apartments SET OHDateTime = '$time' WHERE Plot = '$id'";
		return $this->query($query);
  }

  public function allOwners ($email){
  	$query = "SELECT* FROM owner INNER JOIN allocation ON owner.Owner_ID = allocation.Owner_ID WHERE Employee_ID = (SELECT Employee_ID FROM employee WHERE Email ='$email')";
      return $this->query($query);
  }
  public function allOwnersSearch($email, $value){
  	$query = "SELECT* FROM owner INNER JOIN allocation ON owner.Owner_ID = allocation.Owner_ID WHERE owner.Owner_ID = (SELECT Owner_ID FROM owner WHERE (Email LIKE '$value%' OR Owner_ID = '$value' OR Name LIKE '$value%') AND Employee_ID = (SELECT Employee_ID FROM employee WHERE Email = '$email'))";
      return $this->query($query);
  }

//a_gid functions
public function tenantsearch($search){
  $query = "SELECT Name, Email, Tenant_ID FROM tenant WHERE (Email LIKE '%$search%' OR Name LIKE '%$search%') AND G_ID IS NULL";
  return $this->query($query);
}

public function generategid()
{
  return substr(md5(microtime()),rand(0,26),10);
}

public function tenantgid($value, $id)
{
  $query = "UPDATE tenant SET G_ID = '$value' WHERE Tenant_ID = '$id'";
  return $this->query($query);
}

public function displayImagesAll($value)
 {
   $query = "SELECT ImagesBlob FROM images WHERE Plot = '$value'";
   return $this->query($query);
 }

  /*
  public function addpayment1(Payment $pay)  {
    $query = "INSERT INTO payment (Tenant_ID, Plot,Amount) VALUES ('$pay->tenantid', '$pay->plotid', '$pay->payamount')";
    return $this->query($query);
  }
  public function getautoid(){
    $query ="SELECT Pay_ID FROM payment ORDER BY Pay_ID DESC LIMIT 1;";
    return $this->query($query);
  }
  public function addpayment2($a,$b,$c)  {
    $query = "BEGIN;
              INSERT INTO payment (Tenant_ID, Plot, Amount) VALUES ('$a','$b','$c');
              SELECT LAST_INSERT_ID() INTO @mysql_var;
              INSERT INTO commission (Pay_ID, Employee_ID,Com_Amount) VALUES (@mysql_var,1,'$c');
              COMMIT;";
    return $this->query($query);
  }


BEGIN;
INSERT INTO payment (Tenant_ID, Plot, Pay_Amount) VALUES (1, 21, 15.00);
SELECT LAST_INSERT_ID() INTO @mysql_var;
INSERT INTO commission (@mysql_var,1,15.00);
COMMIT;
INSERT ...
SELECT LAST_INSERT_ID() INTO @mysql_variable_here;
INSERT INTO table2 (@mysql_variable_here, ...);
INSERT INTO table3 (@mysql_variable_here, ...);*/





  public function searchByLocation($value)
  {
    $sql = "SELECT * FROM apartments WHERE Area LIKE '%$value%'";
    return $this->query($sql);
  }
  public function detailsearch($location, $rooms, $price)
  {
    if ($rooms == "" && $price != "") {
      $sql = "SELECT * FROM apartments WHERE ((Area LIKE '%$location%') OR (Address LIKE '%$location%')) AND (Price <= '$price') AND (Available = 1)";
    } elseif ($price == "" && $rooms != "") {
      $sql = "SELECT * FROM apartments WHERE ((Area LIKE '%$location%') OR (Address LIKE '%$location%')) AND (Rooms >= '$rooms') AND (Available = 1)";
    }elseif (($rooms == "") && ($price == "")) {
      $sql = "SELECT * FROM apartments WHERE (Area LIKE '%$location%') OR (Address LIKE '%$location%') AND (Available = 1)";
    }else {
      $sql = "SELECT * FROM apartments WHERE ((Area LIKE '%$location%') OR (Address LIKE '%$location%')) AND ((Rooms >= '$rooms') AND (Price <= '$price')) AND (Available = 1)";
    }
    return $this->query($sql);
  }

  public function allocatedowners($a){
    $sql = "SELECT * FROM owner INNER JOIN allocation ON owner.Owner_ID=allocation.Owner_ID WHERE allocation.Employee_ID=(SELECT Employee_ID FROM employee WHERE Email = '$a') AND owner.G_ID IS NULL";
    return $this->query($sql);//
  }

  public function others($a){
    $query = "SELECT* FROM genuine WHERE Email = '$a'";
    return $this->query($query);
  }
  public function showownerdetails($a){
    $query = "SELECT* FROM owner WHERE Owner_ID = '$a'";
    return $this->query($query);
  }
  public function ownerdetailstotenant($a){
    $query = "SELECT* FROM owner WHERE Owner_ID = (SELECT Owner_ID from apartments where Plot ='$a')";
    return $this->query($query);
  }

	public function newowner(){
		$query = "SELECT* FROM owner WHERE Owner_ID NOT IN (SELECT Owner_ID FROM allocation)";
		return $this->query($query);
	}

	public function showagents(){
		$query = "SELECT* FROM employee WHERE E_Position = 'Agent'";
		return $this->query($query);
	}

	public function assignagent($a,$b){
		$query = "INSERT INTO allocation (Employee_ID, Owner_ID) VALUES ('$a','$b')";
		return $this->query($query);
	}



  public function propertydetails($email){
		$query = "SELECT* FROM apartments WHERE Owner_ID = (SELECT Owner_ID FROM owner where Email ='$email')";
		return $this->query($query);
	}
  public function allocateagent($email){
    $sql = "SELECT * FROM employee INNER JOIN allocation ON employee.Employee_ID=allocation.Employee_ID WHERE allocation.Owner_ID= (SELECT Owner_ID FROM owner where Email ='$email')";
    return $this->query($sql);
  }
  public function tenantdetails($id){
		$query = "SELECT* FROM tenant WHERE Plot = '$id'";
		return $this->query($query);
	}
  public function details($id){
		$query = "SELECT* FROM apartments WHERE Plot = '$id'";
		return $this->query($query);
	}
  public function tenantbyemail($email){
    $query = "SELECT* FROM tenant WHERE Email = '$email'";
    return $this->query($query);
  }
  public function propertydetailstenant($email){
		$query = "SELECT* FROM apartments WHERE Plot = (SELECT Plot FROM tenant where Email ='$email')";
		return $this->query($query);
	}
  public function allocateagenttenant($plot){
    $sql = "SELECT * FROM employee INNER JOIN allocation ON employee.Employee_ID=allocation.Employee_ID WHERE allocation.Owner_ID= (SELECT Owner_ID FROM apartment where Plot ='$plot')";
    return $this->query($sql);
  }




  public function insert_subscribe($a, $b){
 $query = "INSERT INTO subscribe (Email, Plot) VALUES ('$a','$b')";
 return $this->query($query);
 }
 public function Subtracted_Date(){
   $sql = "SELECT OHDateTime, Plot, Address, Area FROM apartments WHERE DATEDIFF(OHDateTime, CURDATE())=1";
   return $this->query($sql);//
 }
 public function Email_notify($a){
   $sql = "SELECT Email FROM subscribe INNER JOIN apartments ON subscribe.Plot = apartments.Plot WHERE apartments.Plot='$a'";
   return $this->query($sql);//
 }
 public function update_subscribe($a, $b){
 $query = "UPDATE subscribe SET Sent = 1 WHERE Email='$a' AND Plot='$b'";
 return $this->query($query);
 }
 public function Email_Date(){
   $sql = "SELECT OHDateTime, subscribe.Plot, Address, Area, Email FROM apartments INNER JOIN subscribe ON subscribe.Plot = apartments.Plot WHERE DATEDIFF(OHDateTime, CURDATE())<=1 AND Sent = '0'";
   return $this->query($sql);
 }




	public function readfile($id,$name,$l){//".date("h:i:s")."
		date_default_timezone_set('Pacific/Fiji');
		$t =date("h:i:sa");
		$d =date("m/d/Y");
		$query = "INSERT INTO test2 VALUES ('$id','$t','$name','$d','$l')";
		return $this-> query($query);
	}
  public function displayImages($value)
  {
    $query = "SELECT Images FROM apartments WHERE Plot = '$value'";
    return $this->query($query);
  }
  private function dbconnect() {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$base = "fijihomesdb";

	$conn = new mysqli($servername, $username, $password, $base);


    return $conn;
  }

  private function query($sql){

    $res = mysqli_query($this->dbconnect(),$sql);

    if ($res){
      if (strpos($sql,'SELECT') === false){
        return true;
      }
    }
    else{
      if (strpos($sql,'SELECT') === false){
        return false;
      }
      else{
        return null;
      }
    }

    $results = array();

    while ($row = mysqli_fetch_array($res)){

      $result = new DALQueryResult();

      foreach ($row as $k=>$v){
        $result->$k = $v;
      }

      $results[] = $result;
    }
    return $results;
  }
}
?>
