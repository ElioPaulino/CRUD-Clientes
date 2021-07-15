<?php
    class HomeController
    {
        public function index(){
            try {
                $colecCliente =  Cliente::listarClientes();

                $loader = new \Twig\Loader\FilesystemLoader('app/view');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('home.html');
                $parametros = array();
                $parametros['clientes']=$colecCliente;
                $conteudo=$template->render($parametros);
                echo $conteudo;



            }catch (Exception $e){
                echo $e->getMessage();
            }

        }
    }