<?php
    namespace Controllers;

    use DAO\CellphoneDAO as CellphoneDAO;
    use DAO\CellphoneDAODB as CellphoneDAODB;
    use Models\Cellphone as Cellphone;
    use Controllers\HomeController as HomeController;
    use \Exception as Exception;

    class CellphoneController
    {
        private $cellphoneDAO;

        public function __construct()
        {
            $this->cellphoneDAO = new CellphoneDAO(); // JSON
            //$this->cellphoneDAO = new CellphoneDAODB(); //PDO
        }

        public function ShowAddCellphoneView($message = "")
        {
            require_once(VIEWS_PATH."add-cellphone.php");
        }     

        public function ShowListCellphoneView($listCellphone, $message = "")
        {
            require_once(VIEWS_PATH."cellphone-list.php");
        }
        
        public function AddCellphone($code, $brand, $model, $price)
        {
            $message = "El celular ha sido cargado con exito";
            if(!$this->cellphoneDAO->GetCellphoneByCode($code))
            {
                $cellphone = new Cellphone();

                $cellphone->setCode($code);
                $cellphone->setBrand($brand);
                $cellphone->setModel($model);
                $cellphone->setPrice($price);

                try {
                    $this->cellphoneDAO->Add($cellphone);                
                } catch (Exception $e) {
                    $message = $e->getMessage();
                }
            }
            else
            {
                $message = "El celular que se desea cargar ya se encuentra en el sistema, intente ingresar otro codigo";
            }

            $this->ShowAddCellphoneView($message);                        
        }

        public function ListCellphone($message = "")
        {
            $listCellphone = $this->cellphoneDAO->GetAll();

            if(!is_array($listCellphone))
             $listCellphone = array($listCellphone); // hago esto para que cuando devuelva un solo valor de la base lo convierta en array para no tener problemas en el cellphone-list

            $this->ShowListCellphoneView($listCellphone, $message); 
        }

        public function RemoveCellphone($id)
        {
            $this->cellphoneDAO->Remove($id);

            $this->ListCellphone();
        }

        public function ShowUpdateCellphoneView($codeCellphone)
        {
            $cellphoneSearch = $this->cellphoneDAO->GetCellphoneByCode($codeCellphone);

            if($cellphoneSearch){
                require_once(VIEWS_PATH."update-cellphone.php");                
            }else{
                $message = "No se ha encontrado el dato a editar";
                $this->ListCellphone($message);   
            }
        }

        public function UpdateCellphone($id, $code, $brand, $model, $price)
        {
            $cellphone = new Cellphone();

            $cellphone->setIdCellphone((int)$id);             
            $cellphone->setCode($code);
            $cellphone->setBrand($brand);
            $cellphone->setModel($model);
            $cellphone->setPrice($price);

            $rowCount = $this->cellphoneDAO->Update($cellphone);
            $message = "Se ha editado el dato correctamente";

            if(!$rowCount){
                $message = "El dato no se edito !";                
            }

            $this->ListCellphone($message);            
        }
    }
?>