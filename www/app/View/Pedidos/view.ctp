<h1>Pedidos Feitos</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Cliente</th>
        <th>Observação</th>
    </tr>

    <?php foreach ($detalhes as $detalhe) : ?>
        <tr>
            <td><?php echo $detalhe['pedidos']['id_pedido']; ?></td>
            <td><?php echo $detalhe['clientes']['cliente_nome']; ?></td>
            <td><?php echo $detalhe['pedidos']['observacao_pedido']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<br>
<table>
    <tr>
        <th>Produtos</th>
    </tr>
    <?php foreach ($produtos as $produto) : ?>
        <tr>
            <td><?php echo $produto['produtos']['nome_produto']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>