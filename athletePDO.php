<?php

require_once "newAthleteCheck.php";

class athletePDO {

	private $db;
	private $amount;

	function __construct($dsn = "mysql:host=localhost;dbname=athletemanager", $user="manager", $password="password")
	{
		$this->db = new PDO($dsn, $user, $password);

		//Report errors while developing
  		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

		//Prevent MySQL injections
	    $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$this->amount=0;
    }

    function getAmount() {
    	return $this->amount;
    }

    public function athleteList()
    {
        $sql = "SELECT ath_id, fName, lName from athletes" ;

		if (! $stmt = $this->db->prepare($sql)) {
			$error = $this->db->errorInfo();

			throw new PDOException($error[2], $error[1]);
		}

 		if (! $stmt->execute()) {
			$error=$stmt->errorInfo();

			throw new PDOException($error[2], $error[1]);
		}

        $result=array();

        while ($row = $stmt->fetchObject()) {
			$check = new NewAthleteCheck();

        	$check->setId($row->ath_id);
        	$check->setFirstname(utf8_encode($row->fName));
        	$check->setLastname(utf8_encode($row->lName));
        	$result[]=$check;
        }
		$this->amount=$stmt->rowCount();

		return $result;
    }


	public function searchAthletes($lName) {
        $sql = "SELECT ath_id, fName, lName FROM athletes
				WHERE lName LIKE :lName";

		if (! $stmt = $this->db->prepare($sql)) {
			$error = $this->db->errorInfo();
			throw new PDOException($error[2], $error[1]);
		}

    	$stmt->bindValue(":lName", "%".$lName."%", PDO::PARAM_STR);

 		if (! $stmt->execute()) {
			$error=$stmt->errorInfo();

			if ($error[0] == "HY093") {
			   $error[2] = "Invalid parameter";
			}

			throw new PDOException($error[2], $error[1]);
		}

        $result=array();

        while ($row = $stmt->fetchObject()) {
        	$check = new NewAthleteCheck();

        	$check->setId($row->ath_id);
        	$check->setFirstname(utf8_encode($row->fName));
        	$check->setLastname(utf8_encode($row->lName));
        	$result[] = $check;
        }

    	$this->amount = $stmt->rowCount();

    	return $result;
	}

	function addNewAthlete($checkNew){
		$sql="insert into athletes (fName, lName, DateOfBirth, address, zipCode, city, phoneNo, email, joinDate, notes)
		values(:firstname, :lastname, :dob, :address, :zip, :city, :phone, :email, :join, :notes)";

		if (! $stmt = $this->db->prepare($sql)) {
			$error=$this->db->errorInfo();
			throw new PDOException($error[2], $error[1]);
		}

		$birth=implode('-',array_reverse(explode('.',$checkNew->getDayOfBirth())));
		$join=implode('-',array_reverse(explode('.',$checkNew->getJoinDate())));

		$stmt->bindValue(":firstname", utf8_decode($checkNew->getFirstname()),PDO::PARAM_STR);
		$stmt->bindValue(":lastname", utf8_decode($checkNew->getLastname()),PDO::PARAM_STR);
		$stmt->bindValue(":dob", $birth);
		$stmt->bindValue(":address", utf8_decode($checkNew->getAddress()),PDO::PARAM_STR);
		$stmt->bindValue(":zip", utf8_decode($checkNew->getZip()),PDO::PARAM_STR);
		$stmt->bindValue(":city", utf8_decode($checkNew->getCity()),PDO::PARAM_STR);
		$stmt->bindValue(":phone", utf8_decode($checkNew->getPhoneNo()),PDO::PARAM_STR);
		$stmt->bindValue(":email", utf8_decode($checkNew->getEmail()),PDO::PARAM_STR);
		$stmt->bindValue(":join", $join);
		$stmt->bindValue(":notes", utf8_decode($checkNew->getNotes()),PDO::PARAM_STR);

		if(!$stmt->execute()){
			$error=$stmt->errorInfo();

			if($error[0]=="HY093"){
				$error[2]="Invalid parameter";
			}

			throw new PDOException($error[2], $error[1]);
		}
	}
	function getAthleteProfile($id){
		$sql="SELECT fName, lName, DateOfBirth, address, zipCode, city, phoneNo, email, joinDate, notes from athletes where ath_id=:id";

		if (! $stmt = $this->db->prepare($sql)) {
			$error=$this->db->errorInfo();
			throw new PDOException($error[2], $error[1]);
		}

		$stmt->bindValue(":id", $id);

		if(!$stmt->execute()){
			$error=$stmt->errorInfo();

			if($error[0]=="HY093"){
				$error[2]="Invalid parameter";
			}

			throw new PDOException($error[2], $error[1]);
		}
        $result=array();

        while ($row = $stmt->fetchObject()) {
        	$check = new NewAthleteCheck();

        	$check->setFirstname(utf8_encode($row->fName));
        	$check->setLastname(utf8_encode($row->lName));
			$bd=implode('.',array_reverse(explode('-',$row->DateOfBirth)));
			$check->setDayOfBirth(utf8_encode($bd));
			$check->setAddress(utf8_encode($row->address));
			$check->setZip(utf8_encode($row->zipCode));
			$check->setCity(utf8_encode($row->city));
			$check->setPhoneNo(utf8_encode($row->phoneNo));
			$check->setEmail(utf8_encode($row->email));
			$joinDate=implode('.',array_reverse(explode('-',$row->joinDate)));
			$check->setJoinDate(utf8_encode($joinDate));
			$check->setNotes(utf8_encode($row->notes));

        	$result[]=$check;
        }

		$this->amount = $stmt->rowCount();

		return $result;
	}
	function deleteAthlete($id){
		$sql="DELETE FROM athletes where ath_id=:id";

		if (! $stmt = $this->db->prepare($sql)) {
			$error=$this->db->errorInfo();
			throw new PDOException($error[2], $error[1]);
		}

		$stmt->bindValue(":id", $id);

		if(!$stmt->execute()){
			$error=$stmt->errorInfo();

			if($error[0]=="HY093"){
				$error[2]="Invalid parameter";
			}

			throw new PDOException($error[2], $error[1]);
		}
	}
}
?>
