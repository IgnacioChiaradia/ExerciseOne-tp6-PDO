<?php
    namespace DAO;

    use DAO\ICellphoneDAO as ICellphoneDAO;
    use DAO\IDAO as IDAO;
    use Models\Cellphone as Cellphone;

    class CellphoneDAO implements ICellphoneDAO, IDAO
    {
        private $cellphoneList = array();

        public function Add(Cellphone $cellphone)
        {
            $this->RetrieveData();

            $cellphone->setIdCellphone($this->GetNextId()); 
            
            array_push($this->cellphoneList, $cellphone);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->cellphoneList;
        }

        public function Remove($id)
        {
            $this->RetrieveData();

            foreach($this->cellphoneList as $key => $cellphone){
                if($cellphone->getIdCellphone() == $id){
                    unset($this->cellphoneList[$key]);
                }
            }

            $this->SaveData();                        
        }

        public function Update(Cellphone $newCellphone)
        {
            $this->RetrieveData();
            $flag = 0;
            
            foreach($this->cellphoneList as $key => $cellphone){
                if($cellphone->getCode() == $newCellphone->getCode()){
                    $this->cellphoneList[$key] = $newCellphone;
                    $flag = 1;
                }
            }

            $this->SaveData();
            return $flag;                        
        }

        public function GetCellphoneByCode($codeCellphone)
        {
            $this->RetrieveData();
            $cellphoneSearch = 0;

            foreach($this->cellphoneList as $cellphone){
                if($cellphone->getCode() == $codeCellphone){
                    $cellphoneSearch = $cellphone;
                }
            }

            return $cellphoneSearch;            
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cellphoneList as $cellphone)
            {
                $valuesArray["idCellphone"] = $cellphone->getIdCellphone();
                $valuesArray["code"] = $cellphone->getCode();
                $valuesArray["brand"] = $cellphone->getBrand();
                $valuesArray["model"] = $cellphone->getModel();
                $valuesArray["price"] = $cellphone->getPrice();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/cellphones.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->cellphoneList = array();

            if(file_exists('Data/cellphones.json'))
            {
                $jsonContent = file_get_contents('Data/cellphones.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cellphone = new Cellphone();
                    $cellphone->setIdCellphone($valuesArray["idCellphone"]);
                    $cellphone->setCode($valuesArray["code"]);
                    $cellphone->setBrand($valuesArray["brand"]);
                    $cellphone->setModel($valuesArray["model"]);
                    $cellphone->setPrice($valuesArray["price"]);

                    array_push($this->cellphoneList, $cellphone);
                }
            }
        }

        private function GetNextId()
        {
            $id = 0;

            foreach($this->cellphoneList as $cellphone)
            {
                $id = ($cellphone->getIdCellphone() > $id) ? $cellphone->getIdCellphone() : $id;
            }

            return $id + 1;
        }
    }
?>