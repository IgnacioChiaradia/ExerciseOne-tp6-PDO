<?php 
	namespace DAODB;

    use \Exception as Exception;
    use \PDOException as PDOException;
    use Interfaces\ICellphoneDAO as ICellphoneDAO;
    use Interfaces\IDAO as IDAO;
    use Models\Cellphone as Cellphone;
    use DAODB\Connection as Connection;

    class CellphoneDAODB implements ICellphoneDAO, IDAO
    {
        private $connection;
        private $tableName = "cellphones";

        public function Add(Cellphone $cellphone)
        {
            $query = "INSERT INTO ".$this->tableName." (code, brand, model, price) VALUES (:code, :brand, :model, :price);";
        	try
            {
                $parameters["code"] = $cellphone->getCode();
                $parameters["brand"] = $cellphone->getBrand();
                $parameters["model"] = $cellphone->getModel();
                $parameters["price"] = $cellphone->getPrice();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
            	$pos = strpos($ex, "23000"); // busco en $ex el error PDOException: SQLSTATE[23000]: Integrity constraint violation

            	if($pos !== FALSE){
            		throw new Exception('El numero del codigo ingresado ya existe.'); 	
            	}else{
            		throw new Exception('ERROR INESPERADO');
            	}
            }
            
        }

        public function GetAll()
        {
            $sql = "SELECT * FROM cellphones";
		    $result = array();

		    try {
		      $this->connection = Connection::getInstance();
		      $resultSet = $this->connection->execute($sql);
		    
		      if(!empty($resultSet))
		      {
		        $result = $this->mapear($resultSet);
		      }
		  	}
		    catch(Exception $e){
		       throw $ex;
		    }
		    return $result;
        }

        public function Remove($id)
        {    
            $query = "DELETE FROM ".$this->tableName." WHERE id_cellphone = :id_cellphone";

        	try
            {
                $parameters["id_cellphone"] = $id;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Update(Cellphone $newCellphone)
        {
            $query = "UPDATE ".$this->tableName." SET code = :code, brand = :brand, model = :model, price = :price WHERE id_cellphone = :id_cellphone";
        	try
            {
            	$parameters["id_cellphone"] = $newCellphone->getIdCellphone();
                
                $parameters["code"] = $newCellphone->getCode();
                $parameters["brand"] = $newCellphone->getBrand();
                $parameters["model"] = $newCellphone->getModel();
                $parameters["price"] = $newCellphone->getPrice();

                $this->connection = Connection::GetInstance();

                $rowCount = $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

            return $rowCount;
        }

        public function GetCellphoneByCode($codeCellphone)
        {
        	$sql = "SELECT * FROM " . $this->tableName . " WHERE code = :code";
		    $result = array();

		    try {
                    $parameters["code"] = $codeCellphone;

            	    $this->connection = Connection::getInstance();
            	    $resultSet = $this->connection->Execute($sql,$parameters);
            	    
            	    if(!empty($resultSet))
            	    {
            	      $result = $this->mapear($resultSet);
            	    }
		  	}
		    catch(Exception $ex){
		       throw $ex;
		    }

		    return $result;
        }

        protected function mapear($value) {
		    $value = is_array($value) ? $value : [];

		    $resp = array_map(function($p){

		    $cellphone = new Cellphone();
            $cellphone->setIdCellphone($p["id_cellphone"]);
            $cellphone->setCode($p["code"]);
            $cellphone->setBrand($p["brand"]);
            $cellphone->setModel($p["model"]);
            $cellphone->setPrice($p["price"]);

		      return $cellphone; 
		    }, $value);
		    return count($resp) > 1 ? $resp : $resp[0]; 
		  }
    }

?>