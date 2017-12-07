 <?php
 
 /**
 * Gestion des informations contenues dans une table d'une base de donnée
 * Nous supposons que la clé est sur une colonne et est de type entier
 */
class DAL {

	protected $db;
	protected $table;
	protected $idKey = 'cid';
	protected $autoIncrement = FALSE;
	protected $defaultOrder;
	protected $rowClass;
	protected $status = 1;
	
 private function requiredProps() {
	return array('db','table','idKey');
 }
 
 
 private function optionalProps() {
	return array('autoIncrement','defaultOrder','rowClass','status');
 }
 
 
	/**
	* Constructeur
	*/
	public function __construct($values) {
		foreach(requiredProps() as $prop) {
			if(isset($values[$prop])) {
				$this->$prop = $values[$prop];
			}
			else {
				$this->status = 0;
			}
		}
		foreach(optionalProps() as $prop) {
			if(isset($values[$prop])) {
				$this->$prop = $values[$prop];
			}
		}
	}
	
	/**
	* loadById
	* méthode permettant de lire une ligne de la table
	* utilise la fonction db_query
	*/
	public function loadById($id) {
		 
		 //activation de la base de données
		 db_set_active($this->db);
		 
		 //construction du code SQL
		 $sql = 'SELECT * FROM {'.$this->table.'} WHERE '.$this->idKey.' = :cid';
		 
		 //préparation et exécution de la requête
		 //renvoi d'un objet DatabaseStatement (PDOStatement)
		 $stmt = db_query($sql, array(':cid' => $id));
		 $class = isset($this->rowClass) ? $this->rowClass : 'stdClass';
		 
		 //renvoie la ligne courante sous forme d'objet
		 $obj=$stmt->fetchObject($class);
		 
		 db_set_active();
		 return $obj;
	 }
	 
	 
	 /**
	 * load : méthode permettant de lire toute la table
	 * utilise la fonction db_select qui crée un objet de la classe SelectQuery
	 */
	 public function load($ids = array(), $conditions = array(), $order = array()) {
		 db_set_active($this->db);
		 
		 //Création d'un objet de la classe SelectQuery pour la Connection active
		 $query = db_select($this->table)
		 
		 ->fields($this->table); //tous les champs
		 //traitement de l'argument $ids
		 if (!empty($ids)) {
			$query->condition($this->idKey, $ids, 'IN');
		 }
		 
		 //traitement de l'argument $conditions
		 if (!empty($conditions)) {
			 foreach($conditions as $cond) {
			 $field = $cond[0];
			 $value = isset($cond[1]) ? $cond[1] : NULL;
			 $operator = isset($cond[2]) ? $cond[2] : NULL;
			 $query->condition($field, $value, $operator);
			 }
		 }
		 
		 //traitement de l'argument $order
		 if (isset($order)) {
			 foreach($order as $field => $direction) {
				$query->orderBy($field, $direction);
			 }
		 }
		 
		 //tri par defaut
		 else if (isset($this->defaultOrder)) {
			 foreach($this-> defaultOrder as $field => $direction) {
				$query->orderBy($field, $direction);
			 }
		 }
		  
		 //classe des objets qui seront renvoyés
		 $class = isset($this->rowClass) ? $this->rowClass : 'stdClass';
		 //exécution de la requête et récupération d'un tableau d'objets
		 $result = $query->execute()->fetchAll(PDO::FETCH_CLASS, $class);
		 db_set_active();
		 return $result;
	 }
	/**
	 * méthode insert
	 * teste si on a un auto-increment,
	 * suppose que les variables de l'objet
	 * et les champs de la table ont les mêmes noms
	 */
	 public function insert($obj) {
		 $values = (array) $obj;
		 if($this->autoIncrement) {
			unset($values[$this->idKey]);
		 }
		 db_set_active($this->db);
		 $id = db_insert($this->table) //http://drupal.org/node/310079
		 ->fields($values)
		 ->execute();
		 db_set_active();
		 return $id; //valeur de l'auto-increment pour la ligne créée
	 }
	/**
	 * méthode update
	 */
	public function update($obj) {
		$id = $obj->{$this->idKey};
		$values = (array) $obj;
		unset($values[$this->idKey]);
		db_set_active($this->db);
		$num = db_update($this->table)
		->condition($this->idKey, $id)
		->fields($values)
		->execute();
		db_set_active();
		return ($num == 1);
	}
	/**
	 * méthode delete
	 */
	public function delete($obj) {
		$id = $obj->{$this->idKey};
		db_set_active($this->db);
		$deleted = db_delete($this->table)
		->condition($this->idKey, $id)
		->execute();
		db_set_active();
		return (bool) $deleted;
	}
}

