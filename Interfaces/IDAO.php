<?php
    namespace Interfaces;

    use Models\Cellphone as Cellphone;

    interface IDAO
    {
        function GetAll();
        function Remove($id);
    }
?>