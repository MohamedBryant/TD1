<?php

/**
 * Objet métier employé
 */
class Contact {
 public $cid;
 public $nom;
 public $prenom;
 public $adresse;
 public $telephone;
 public $email;
 
 //variable statique DAL
 protected static $_dal;
 
 
 public static function dal() {
	 if (!isset(static::$_dal)) {
		 $config = array(
			 'db' => 'commercial',
			 'table' => 'contact',
			 'idKey' => 'cid',
			 'autoIncrement' => TRUE,
			 'defaultOrder' => array('nom' => 'asc'),
			 'rowClass' => 'Contact',
		 );
		 static::$_dal = new Contact($config);
	 }
 return static::$_dal;
 }
 
 public static function create( $values = null ) {
	if (empty($values)) {
		$values = array('cid' => 0);
	}
	return new Contact($values);
 }
 
 public static function get($id) {
	return static::dal()->loadById($id);
 }
 
 
 Public static function get_all(){
	return static::dal()->load();
 }
 
 
 public function insert() {
	return static::dal()->insert($this);
 }
 
 
 Public function update() {
	return static::dal()->update($this);
 }
 
 
 public function delete() {
	return static::dal()->delete($this);
 }
 
}