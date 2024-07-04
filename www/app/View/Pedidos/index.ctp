<h1>Pedidos Feitos</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Data</th>
        <th>Cliente</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($pedidos as $pedido): ?>
    <tr>
        <td><?php echo $this->Html->link($pedido['pedidos']['id_pedido'], array('controller' => 'pedidos', 'action' => 'view', $pedido['pedidos']['id_pedido'])); ?></td>
        <td><?php echo $pedido['clientes']['cliente_nome']; ?></td>
        <td><?php echo $pedido['pedidos']['pedido_data']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php echo $this->Html->link(
    'Criar pedido',
    array('controller' => 'pedidos', 'action' => 'add')
); ?>
