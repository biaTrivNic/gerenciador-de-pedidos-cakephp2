
<h1>Criar pedido</h1>
<?php
echo $this->Form->create('Post');
echo $this->Form->select('Cliente', Hash::combine($clientes, '{n}.clientes.nome', '{n}.clientes.nome'),
    ['empty' => 'Selecione o cliente', 'label' => 'Selecione o cliente'] 
);?>
<br>
<br>
<?php
echo $this->Form->select('Produtos', Hash::combine($produtos, '{n}.produtos.nome', '{n}.produtos.nome'),
    ['label' => 'Selecione o produto', 'multiple' => true] 
);
echo $this->Form->input('Observações', array('rows' => '3'));
echo $this->Form->end('Criar pedido');
?>

