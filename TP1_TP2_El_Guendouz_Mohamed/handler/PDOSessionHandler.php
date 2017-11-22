<?php
class MySessionHandler implements SessionHandlerInterface
{
    private $savePath;
	private $pdo;


    public function open($savePath, $sessionName)
    {
        $dsn = 'mysql:dbname=sessionbd';
		$host= '127.0.0.1';
		$user = 'root';
		$password = '';

		try {
			
			$this->pdo = new PDO($dsn, $user, $password);
		} catch (PDOException $e) 
		{
			echo 'Connexion échouée : ' . $e->getMessage();
		}

        return true;
    }

	public function close()
    {
		$this->$pdo = null ;
        return true;
    }
	
    public function read($sid)
    {
		$sql =  'SELECT sid, ipadress, timestamp, data FROM session ORDER BY timestamp WHERE sid = $sid';
		foreach  ($this->$this->pdo->query($sql) as $row) 
		{
			print ($row['sid'] . "\t");
			print ($row['ipadress'] . "\t");
			print ($row['timestamp'] . "\t");
			print ($row['data'] . "\n");
		}
    }

    public function write($sid, $data)
    {
        $stmt = $this->pdo->prepare('INSERT INTO session (sid,ipadress,timestamp,data) VALUES ($sid,,REQUEST_TIME,$data)');
		$stmt->bindParam(':data', $data);
		
		//$stmt = $this->pdo->prepare('UPDATE session(sid,ipadress,timestamp,data) SET(:sid,:ipadress,:timestamp,:data) WHERE sid=$sid');
		$stmt->execute();
    }

    public function destroy($sid)
    {
        $req = $pdo->exec('DELETE FROM session WHERE sid = $sid');

        return true;
    }

    public function gc($maxlifetime)
    {

		$req = $pdo->exec('DELETE FROM session WHERE timestamp > (REQUEST_TIME-$maxlifetime)');
        return true;
    }
}
session_start();
$handler = new MySessionHandler();
session_set_save_handler($handler, true);
$_SESSION['val1']="mohamed" ;
$_SESSION['val2']="elguendouz" ;
var_dump($_SESSION);
