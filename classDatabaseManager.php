<?php	
	date_default_timezone_set("Europe/Stockholm");
	class databaseManager {
		private $dns='mysql:host=hostNameOrIP;dbname=databaseName;charset=utf8';
		private $username='root';
		private $password='';
		private $db_conn=NULL;
		function __construct(){
			try {   
				$this->db_conn = new PDO($this->dns, $this->username , $this->password );
			} catch (PDOException $e) {			
				/* echo "Could not connect to database";  
				exit;  */
				return false;
			}
		}
		
		function executeQuery($query, $values, $type){					
			try {  
				$statement = $this->db_conn->prepare($query); 
				if($statement) {
					switch($type){
						case 'create':					
							$result=$statement->execute($values);							
							if($result){
								$result=$this->db_conn->lastInsertId();		
								return $result;
							}else{
								$error = $statement->errorInfo();    
								echo "Query failed with message: " . $error[2];								
								return false;
							}
						break;
						
						case 'cread':
							$result = $statement->execute($values);    
							if($result) {    
								$result = $statement->fetchAll(PDO::FETCH_ASSOC);    
								/* echo '<pre>';
									print_r($result);  
								echo '</pre>'; */
								return $result;
							} else {    
								$error = $statement->errorInfo();    
								echo "Query failed with message: " . $error[2];  
								return false;
							}
						break;
						case 'sread':
							$result = $statement->execute();    
							if($result) {    
								$result = $statement->fetchAll();    
								return $result;
							} else {    
								$error = $statement->errorInfo();    
								echo "Query failed with message: " . $error[2];  
							}
						break;
						
						case 'update':
							
							$result=$statement->execute($values);							
							if($result){	
								return true;
							}else{
								$error = $statement->errorInfo();    
								echo "Query failed with message: " . $error[2];								
								return false;
							}
						break;
						
						case 'delete':
							$result = $statement->execute($values);    
							if($result) {    							   
								return $result;
							} else {    
								$error = $statement->errorInfo();    
								echo "Query failed with message: " . $error[2];  
							}						
						break;
						
						default:
							echo 'invalide query type';
					}				 
				}
			} catch (PDOException $e) {  
				echo "A database problem has occurred: " . $e->getMessage(); 
			}	
		}
		
		public function startTransaction(){
			$this->db_conn->beginTransaction();
		}
		public function commitTransaction(){
			$this->db_conn->commit();
		}
		public function rollBackTransaction(){
			  $this->db_conn->rollBack();
		}
		
	}
?>
