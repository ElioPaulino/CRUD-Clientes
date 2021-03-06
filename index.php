<?php
    require_once 'app/Core/Core.php';
    require_once 'app/Controller/HomeController.php';
    require_once 'app/Controller/ErroController.php';
    require_once 'app/Controller/PostController.php';
    require_once 'app/Controller/GerenciarController.php';
    require_once 'app/Model/Cliente.php';
    require_once 'lib/Database/Connection.php';
    require_once 'vendor/autoload.php';

    $template = file_get_contents('app/template/estrutura.html');
ob_start();
    $core = new Core;
    $core->start($_GET);
    $saida = ob_get_contents();
ob_end_clean();

    $tempPronto = str_replace('{{area_dinamica}}' ,$saida ,$template);
    echo $tempPronto;
