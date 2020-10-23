<?php
    namespace DAO;

    use Models\Cellphone as Cellphone;

    interface ICellphoneDAO
    {
        function Add(Cellphone $cellphone);
        function Update(Cellphone $newCellphone);
    }
?>