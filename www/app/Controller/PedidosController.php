<?php

class PedidosController extends AppController
{
    public function index()
    {
        $this->set("pedidos", $this->Pedido->query("select pedidos.id as id_pedido, pedidos.created as pedido_data, clientes.nome as cliente_nome from pedidos join clientes on pedidos.cliente_id = clientes.id"));
    }

    public function view($id = null)
    {
        // $this->set("detalhes", $this->Pedido->query("select pedidos.id as id_pedido, clientes.nome as cliente_nome, produtos.nome as nome_produto, pedidos.observacao as observacao_pedido from pedidos join clientes on pedidos.cliente_id = clientes.id join produtos_pedidos on pedidos.id = produtos_pedidos.pedido_id join produtos on produtos_pedidos.produto_id = produtos.id where pedidos.id = {$id}"));
        $this->set("detalhes", $this->Pedido->query("select pedidos.id as id_pedido, clientes.nome as cliente_nome, pedidos.observacao as observacao_pedido from pedidos join clientes on pedidos.cliente_id = clientes.id where pedidos.id = {$id}"));

        $this->set("produtos", $this->Pedido->query("select pedidos.id as id_pedido, produtos.nome as nome_produto from pedidos join produtos_pedidos on pedidos.id = produtos_pedidos.pedido_id join produtos on produtos_pedidos.produto_id = produtos.id where pedidos.id = {$id}"));
    }

    public function add(){
        $this->set("clientes", $this->Pedido->query("select nome from clientes"));
        $this->set("produtos", $this->Pedido->query("select nome from produtos"));

    }
}
