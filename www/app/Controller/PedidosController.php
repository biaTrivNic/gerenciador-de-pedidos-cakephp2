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

    public function add()
    {
        $this->set("clientes", $this->Pedido->query("select nome from clientes"));
        $this->set("produtos", $this->Pedido->query("select nome from produtos"));

        if ($this->request->is('post')) {
            $data = $this->request->data;

            $clienteSelecionado = $data['Pedido']['Cliente'];
            $produtosSelecionados = $data['Pedido']['Produtos'];
            $observacoes = $data['Pedido']['Observações'];

            $clienteId = $this->Pedido->query('select id from clientes where nome = :nome', ['nome' => $clienteSelecionado]);

            $this->Pedido->query('
                insert into pedidos (cliente_id, observacao, created, modified) values (:clienteId, :observacao, NOW(), NOW())
            ', [
                'clienteId' => $clienteId[0]['clientes']['id'],
                'observacao' => $observacoes
            ]);

            $lastId = $this->Pedido->query('select last_insert_id() as id');
            $pedidoId = $lastId[0][0]['id'];

            foreach ($produtosSelecionados as $produto) {
                $produtoId = $this->Pedido->query('select id from produtos where nome = :nome', ['nome' => $produto]);

                if ($produtoId) {
                    $this->Pedido->query('
                        insert into produtos_pedidos (pedido_id, produto_id, vl_unitario, qt_produto, unidade, observacao, created, modified) values (:pedidoId, :produtoId, :vlUnitario, :qtProduto, :unidade, :observacao, NOW(), NOW())
                    ', [
                        'pedidoId' => $pedidoId,
                        'produtoId' => $produtoId[0]['produtos']['id'],
                        'vlUnitario' => 0,
                        'qtProduto' => 1,
                        'unidade' => '',
                        'observacao' => '',
                    ]);
                }
            }

            return $this->redirect(['action' => 'add']);
        }
    }
}
