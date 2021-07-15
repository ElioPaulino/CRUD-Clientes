<?php
class GerenciarController
{
    public function index(){
        try {

            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('gerenciar.html');
            $objClientes= Cliente::listarClientes();
            $parametros = array();

            $parametros['clientes'] = $objClientes;

            $conteudo=$template->render($parametros);
            echo $conteudo;



        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

    public function create(){
        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('create.html');
        $parametros = array();

        $conteudo=$template->render($parametros);
        echo $conteudo;
    }

    public function insert(){
        try {
            Cliente::insert($_POST);
            echo '<script>alert("Cadastro realizado com sucesso!");</script>';
            echo '<script>location.href="http://localhost/SistemaCadastroCliente/?pagina=gerenciar"</script>';
        }catch (Exception $e){
            echo '<script>alert("',$e->getMessage(),'");</script>';
            echo '<script>location.href="http://localhost/SistemaCadastroCliente/?pagina=gerenciar&metodo=create"</script>';
        }
    }

    public function alter($paramId){
        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('update.html');
        $cli=Cliente::especificarCliente($paramId);
        $parametros = array();
        $parametros['id']=$cli->id_cliente;
        $parametros['nome']=$cli->nome_cliente;
        $parametros['endereco']=$cli->ender_cliente;
        $parametros['bairro']=$cli->bairro_cliente;
        $parametros['cidade']=$cli->cidade_cliente;
        $parametros['cep']=$cli->cep_cliente;
        $parametros['uf']=$cli->uf_cliente;
        $parametros['telefone']=$cli->telefone_cliente;
        $parametros['celular']=$cli->celular_cliente;

        $conteudo=$template->render($parametros);
        echo $conteudo;
    }


    public function update(){
        try {
            Cliente::update($_POST);
            echo '<script>alert("Alteração realizada com sucesso!");</script>';
            echo '<script>location.href="http://localhost/SistemaCadastroCliente/?pagina=gerenciar"</script>';
        } catch (Exception $e){
            echo '<script>alert("',$e->getMessage(),'");</script>';
          }


    }

    public function delete($paramId){


        try {
            Cliente::delete($paramId);
            echo '<script>alert("Cliente deletado com sucesso!");</script>';
            echo '<script>location.href="http://localhost/SistemaCadastroCliente/?pagina=gerenciar"</script>';
        } catch (Exception $e){
            echo '<script>alert("',$e->getMessage(),'");</script>';
            echo '<script>location.href="http://localhost/SistemaCadastroCliente/?pagina=gerenciar"</script>';
        }

    }
}