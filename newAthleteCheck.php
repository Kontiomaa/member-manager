<?php
	class NewAthleteCheck{
		private static $errorlist=array(
			-1=>"Unknown error",
			0=>"",
			11 => "Provide a first name",
			12 => "Only letters allowed",
			13 => "Need more characters",
			14 => "Too many characters",
			21 => "Provide a last name",
			22 => "Only letters allowed",
			23 => "Need more characters",
			24 => "Too many characters",
			31 => "Can't be left empty",
			32 => "Use format: dd.mm.yyyy",
			33 => "Not a real date",
			34 => "Can't be later than today",
			41 => "Provide an address",
			42 => "Address too short",
			43 => "Address too long",
			51 => "Provide a zip code",
			52 => "Only numbers in zip code",
			53 => "Zip code consists of 5 numbers",//in Finland
			61 => "Provide a city",
			62 => "Only letters",
			63 => "City too short",
			64 => "City too long",
			71 => "Provide a Telephone number",
			72 => "number too short", //if <10
			73 => "number too long", //if >13
			74 => "Not in correct format",
			81 => "Provide an email",
			82 => "Not in correct format",
			83 => "Email too short", //if <5
			84 => "Email too long", //if >50
			91 => "Provide a join date",
			92 => "Use format: dd.mm.yyyy",
			93 => "Not a real date",
			94 => "Can't be later than today",
			101 => "Provide notes", //default false
			102 => "Notes too short", //if <10
			103 => "Notes too long", //if >200
		);
		public static function getError($errorcode){
			if(isset(self::$errorlist[$errorcode])){
				return self::$errorlist[$errorcode];
			}
			return self::$errorlist[-1];
		}

		private $firstname;
		private $lastname;
		private $dateOfBirth;
		private $address;
		private $zip;
		private $city;
		private $phoneNo;
		private $email;
		private $joinDate;
		private $notes;
		private $id;

		function __construct($firstname="", $lastname="", $dateOfBirth="", $address="", $zip="", $city="", $phoneNo="", $email="", $joinDate="", $notes="", $id=0){
			$this->firstname=trim(ucwords($firstname));
			$this->lastname=trim(ucwords($lastname));
			$this->dateOfBirth=trim($dateOfBirth);
			$this->address=trim(ucwords($address));
			$this->zip=trim($zip);
			$this->city=trim(ucwords($city));
			$this->phoneNo=trim($phoneNo);
			$this->email=trim($email);
			$this->joinDate=trim($joinDate);
			$this->notes=trim($notes);
			$this->id=$id;
		}

		public function setId($id){
			$this->id=trim($id);
		}

		public function getId(){
			return $this->id;
		}

		public function setFirstname($firstname){
			$this->firstname=trim($firstname);
		}

		public function getFirstname(){
			return $this->firstname;
		}

		public function checkFirstname($required=true, $min = 3, $max = 50) {
			//if allowed to be empty and is empty
			if ($required == false && strlen($this->firstname) == 0)
				return 0;

			//if not allowed to be empty and is empty
			if ($required == true && strlen($this->firstname) == 0)
				return 11;

			//if incorrect format
			if (preg_match("/[^a-zåäöA-ZÅÄÖ\- ]/", $this->firstname))
				return 12;

			//if too short
			if (strlen($this->firstname)<$min)
				return 13;

			//if too long
			if (strlen($this->firstname)>$max)
				return 14;

			//Everything ok
			return 0;
		}
		public function setLastname($lastname){
			$this->lastname=trim($lastname);
		}

		public function getLastname(){
			return $this->lastname;
		}

		public function checkLastname($required=true, $min=3, $max=50) {
			//if allowed to be empty and is empty
			if ($required==false && strlen($this->lastname)==0)
				return 0;

			//if not allowed to be empty and is empty
			if ($required==true && strlen($this->lastname)==0)
				return 21;

			//if incorrect format
			if (preg_match("/[^a-zåäöA-ZÅÄÖ\- ]/", $this->lastname))
				return 22;

			//if too short
			if (strlen($this->lastname)<$min)
				return 23;

			//if too long
			if (strlen($this->lastname)>$max)
				return 24;

			//Everything ok
			return 0;
		}

		public function setDayOfBirth($dateOfBirth){
			$this->dateOfBirth=trim($dateOfBirth);
		}
		public function getDayOfBirth(){
			return $this->dateOfBirth;
		}
		public function checkDayOfBirth($required=true){
			
			//if allowed to be empty and is empty
			if ($required==false && strlen($this->dateOfBirth)==0)
				return 0;

			//if not allowed to be empty and is empty
			if ($required==true && strlen($this->dateOfBirth)==0)
				return 31;

			//if incorrect format
			if (!preg_match("/^\d{1,2}\.\d{1,2}\.\d{4}$/",$this->dateOfBirth))
				return 32;

			list($dd, $mm, $yy)=explode(".", $this->dateOfBirth);

			//if not a valid Gregorian date
			if(!checkdate($mm,$dd,$yy))
				return 33;

			//check if provided date is later than today
			$currentDate=strtotime(date("d-m-Y"));
			//list($dd, $mm, $yy)=explode(".", $this->dateOfBirth);
			$dateArray=array($dd, $mm, $yy);
			$selectedDate=implode("-", $dateArray);
			$selectedDate=strtotime($selectedDate);

			if($selectedDate>$currentDate)
				return 34;

			//Everything ok
			return 0;
		}

		public function setAddress($address){
			$this->address=trim($address);
		}
		public function getAddress(){
			return $this->address;
		}
		public function checkAddress($required=true, $min=4, $max=50){
			//if allowed to be empty and is empty
			if ($required==false && strlen($this->address)==0)
				return 0;

			//if not allowed to be empty and is empty
			if ($required==true && strlen($this->address)==0)
				return 41;

			//if too short
			if (strlen($this->address)<$min)
				return 42;

			//if too long
			if (strlen($this->address)>$max)
				return 43;

			//Everything ok
			return 0;
		}

		public function setZip($zip){
			$this->zip=trim($zip);
		}
		public function getZip(){
			return $this->zip;
		}
		public function checkZip($required=true, $value=5){
			//if allowed to be empty and is empty
			if ($required==false && strlen($this->zip)==0)
				return 0;

			//if not allowed to be empty and is empty
			if ($required==true && strlen($this->zip)==0)
				return 51;

			//if incorrect format
			if (!preg_match("/^[0-9]*$/", $this->zip))
				return 52;

			//if incorrect lenght
			if (strlen($this->zip)!=$value)
				return 53;

			//Everything ok
			return 0;
		}

		public function setCity($city){
			$this->city=trim($city);
		}
		public function getCity(){
			return $this->city;
		}
		public function checkCity($required=true, $min=2, $max=50){
			//if allowed to be empty and is empty
			if ($required==false && strlen($this->city)==0)
				return 0;

			//if not allowed to be empty and is empty
			if ($required==true && strlen($this->city)==0)
				return 61;

			//if incorrect format
			if (preg_match("/[^a-zåäöA-ZÅÄÖ\- ]/", $this->city))
				return 62;

			//if too short
			if (strlen($this->city)<$min)
				return 63;

			//if too long
			if (strlen($this->city)>$max)
				return 64;

			//Everything ok
			return 0;
		}

		public function setPhoneNo($phoneNo){
			$this->phoneNo=trim($phoneNo);
		}
		public function getPhoneNo(){
			return $this->phoneNo;
		}
		public function checkPhoneNo($required=true, $min=10, $max=13){
			//if allowed to be empty and is empty
			if ($required==false && strlen($this->phoneNo)==0)
				return 0;

			//if not allowed to be empty and is empty
			if ($required==true && strlen($this->phoneNo)==0)
				return 71;

			//if incorrect format
			if (!preg_match("/^[\+0-9\s]*$/", $this->phoneNo))
				return 74;

			//if too short
			if (strlen($this->phoneNo)<$min)
				return 72;

			//if too long
			if (strlen($this->phoneNo)>$max)
				return 73;

			//Everything ok
			return 0;
		}

		public function setEmail($email){
			$this->email=trim($email);
		}
		public function getEmail(){
			return $this->email;
		}
		public function checkEmail($required=true, $min=5, $max=50){
			//if allowed to be empty and is empty
			if ($required == false && strlen($this->email)==0)
				return 0;

			//if not allowed to be empty and is empty
			if ($required == true && strlen($this->email)==0)
				return 81;

			//if too short
			if (strlen($this->email)<$min)
				return 83;

			//if too long
			if (strlen($this->email)>$max)
				return 84;

			//if incorrect format
			if (filter_var($this->email, FILTER_VALIDATE_EMAIL)===false)
				return 82;

			//Everything ok
			return 0;
		}

		public function setJoinDate($joinDate){
			$this->joinDate=trim($joinDate);
		}
		public function getJoinDate(){
			return $this->joinDate;
		}
		public function checkJoinDate($required=true){
			
			//if allowed to be empty and is empty
			if ($required==false && strlen($this->joinDate)==0)
				return 0;

			//if not allowed to be empty and is empty
			if ($required==true && strlen($this->joinDate)==0)
				return 91;

			//if incorrect format
			if (!preg_match("/^\d{1,2}\.\d{1,2}\.\d{4}$/",$this->joinDate))
				return 92;

			list($dd, $mm, $yy)=explode(".", $this->joinDate);

			//if not a valid Gregorian date
			if(!checkdate($mm,$dd,$yy))
				return 93;

			//check if provided date is later than today
			$currentDate=strtotime(date("d-m-Y"));
			//list($dd, $mm, $yy)=explode(".", $this->joinDate);
			$dateArray=array($dd, $mm, $yy);
			$selectedDate=implode("-", $dateArray);
			$selectedDate=strtotime($selectedDate);

			if($selectedDate>$currentDate)
				return 94;

			//Everything ok
			return 0;
		}

		public function setNotes($notes){
			$this->notes=trim($notes);
		}
		public function getNotes(){
			return $this->notes;
		}
		public function checkNotes($required=false, $min=10, $max=200){
			//if allowed to be empty and is empty
			if ($required==false && strlen($this->notes)==0)
				return 0;

			//if not allowed to be empty and is empty
			if ($required==true && strlen($this->notes)==0)
				return 101;

			//if too short
			if (strlen($this->notes)<$min)
				return 102;

			//if too long
			if (strlen($this->notes)>$max)
				return 103;

			//Everything ok
			return 0;
		}
	}
?>
