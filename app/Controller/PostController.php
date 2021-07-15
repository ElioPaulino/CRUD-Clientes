<?php
class PostController
{
    public function index($params){
        try {
            $Cliente =  Cliente::especificarCliente($params);

            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('espec.html');
            $parametros = array();
            $parametros['clientes']=$Cliente;
            $conteudo=$template->render($parametros);
            echo $conteudo;



        }catch (Exception $e){
            echo $e->getMessage();
        }

    }
}