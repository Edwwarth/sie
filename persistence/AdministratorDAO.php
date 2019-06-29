<?php
class AdministratorDAO{
	private $idAdministrator;
	private $name;
	private $lastName;
	private $email;
	private $password;
	private $picture;
	private $phone;
	private $mobile;

	function AdministratorDAO($pIdAdministrator = "", $pName = "", $pLastName = "", $pEmail = "", $pPassword = "", $pPicture = "", $pPhone = "", $pMobile = ""){
		$this -> idAdministrator = $pIdAdministrator;
		$this -> name = $pName;
		$this -> lastName = $pLastName;
		$this -> email = $pEmail;
		$this -> password = $pPassword;
		$this -> picture = $pPicture;
		$this -> phone = $pPhone;
		$this -> mobile = $pMobile;
	}

	function logIn($email, $password){
		return "select idAdministrator, name, lastName, email, password, picture, phone, mobile
				from Administrator
				where email = '" . $email . "' and password = '" . md5($password) . "'";
	}

	function insert(){
		return "insert into Administrator(name, lastName, email, password, picture, phone, mobile)
				values('" . $this -> name . "', '" . $this -> lastName . "', '" . $this -> email . "', md5('" . $this -> password . "'), '" . $this -> picture . "', '" . $this -> phone . "', '" . $this -> mobile . "')";
	}

	function update(){
		return "update Administrator set 
				name = '" . $this -> name . "',
				lastName = '" . $this -> lastName . "',
				email = '" . $this -> email . "',
				picture = '" . $this -> picture . "',
				phone = '" . $this -> phone . "',
				mobile = '" . $this -> mobile . "'	
				where idAdministrator = '" . $this -> idAdministrator . "'";
	}

	function updatePassword($password){
		return "update Administrator set 
				password = '" . md5($password) . "'
				where idAdministrator = '" . $this -> idAdministrator . "'";
	}

	function existEmail($email){
		return "select idAdministrator, name, lastName, email, password, picture, phone, mobile
				from Administrator
				where email = '" . $email . "'";
	}

	function recoverPassword($email, $password){
		return "update Administrator set 
				password = '" . md5($password) . "'
				where email = '" . $email . "'";
	}

	function updateImage($attribute, $value){
		return "update Administrator set "
				. $attribute . " = '" . $value . "'
				where idAdministrator = '" . $this -> idAdministrator . "'";
	}

	function select() {
		return "select idAdministrator, name, lastName, email, password, picture, phone, mobile
				from Administrator
				where idAdministrator = '" . $this -> idAdministrator . "'";
	}

	function selectAll() {
		return "select idAdministrator, name, lastName, email, password, picture, phone, mobile
				from Administrator";
	}

	function selectAllOrder($orden, $dir){
		return "select idAdministrator, name, lastName, email, password, picture, phone, mobile
				from Administrator
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idAdministrator, name, lastName, email, password, picture, phone, mobile
				from Administrator
				where name like '%" . $search . "%' or lastName like '%" . $search . "%' or email like '%" . $search . "%' or phone like '%" . $search . "%' or mobile like '%" . $search . "%'";
	}
}
?>
