<?php
    namespace DAO;

    use Models\Cellphone as Cellphone;

    interface IDAO
    {
        function GetAll();
        function Remove($id);
    }
?>