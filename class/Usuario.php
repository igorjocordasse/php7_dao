<?php

Class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	function getIdusuario(){
		return $this->idusuario;
	}

	function setIdusuario($value){
		$this->idusuario = $value;
	}

	function getDeslogin(){
		return $this->deslogin;
	}

	function setDeslogin($value){
		$this->deslogin = $value;
	}

	function getDessenha(){
		return $this->dessenha;
	}

	function setDessenha($value){
		$this->dessenha = $value;
	}

	function getDtcadastro(){
		return $this->dtcadastro;
	}

	function setDtcadastro($value){
		$this->dtcadastro = $value;
	}


	function setData($data){

		$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}


	function loadById($id){

		$sql = new sql();

		$results = $sql->select("select * from tb_usuarios where idusuario = :ID", array(
			":ID"=>$id
		));

		if(count($results) > 0 )

			$this->setData($results[0]);
		
	}

	static function getList(){

		$sql = new sql();

		return $sql->select("select * from tb_usuarios order by deslogin"); 
	}

	static function search($login){

		$sql = new sql();

		return $sql->select("select * from tb_usuarios where deslogin like :SEARCH order by deslogin",array(
			":SEARCH"=>"%".$login."%"
		));
	}

	function login($login,$password){

		$sql = new sql();

		$results = $sql->select("select * from tb_usuarios where deslogin = :LOGIN and dessenha = :PASSWORD", array(
					":LOGIN"=>$login,
					":PASSWORD"=>$password
		));

		if(count($results) > 0 ){

			$this->setData($results[0]);
		} else{

			throw new Exception("Error Processing Request");
			
		}
	}

	function insert(){

		$sql = new sql();

		$results = $sql->select("call sp_usuarios_insert(:LOGIN,:PASSWORD)", array(

			":LOGIN"=>$this->getDeslogin(),
			":PASSWORD"=>$this->getDessenha()
		));

		if (count($results) > 0) 
			
		$this->setData($results[0]);
	}


	function update($login,$password){

		$this->setDeslogin($login);
		$this->setDessenha($password);

		$sql = new sql();

		 $sql->query("update tb_usuarios set deslogin = :LOGIN, dessenha=:PASSWORD where idusuario=:ID", array(

			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha(),
			':ID'=>$this->getIdusuario()
		));
	}

	function delete(){

		$sql = new sql();

		$sql->query("delete from tb_usuarios where idusuario=:ID", array(

			':ID'=>$this->getIdusuario()
		));

		$this->setDeslogin(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());
	}

	function __construct($login = "",$password = ""){

		$this->setDeslogin($login);
		$this->setDessenha($password);
	}

	function __toString(){

	return json_encode(array(

			'idusuario'=>$this->getIdusuario(),
			'deslogin'=>$this->getDeslogin(),
			'dessenha'=>$this->getDessenha(),
			'dtcadastro'=>$this->getDtcadastro()->format("d/m/Y h:i:s")
		));
	}

}