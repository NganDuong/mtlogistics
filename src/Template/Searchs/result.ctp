<table>
    <tr>
        <th><?= __('No.')?></th>
        <th><?= __('Customer')?></th>
        <th><?= __('Customer\'s phone')?></th>
        <th><?= __('Product')?></th>
        <th><?= __('Price')?></th>
        <th><?= __('Quantity')?></th>
        <th><?= __('Order at')?></th>
    </tr>
    <?php foreach ($orders as $order): ?>
    <tr>
        <td><?= $this->Html->link($order->order_code, ['controller' => 'Orders', 'action' => 'view', $order->id]) ?></td>
        <td><?= h($order->customer->name) ?></td>
        <td><?= $this->Html->link($order->customer->phone, ['controller' => 'Customers', 'action' => 'view', $order->customer_id]) ?></td>
        <td><?= h($order->product->name) ?></td>
        <td><?= h($order->price) ?></td>
        <td><?= h($order->quantity) ?></td>
        <td><?= h($order->order_date) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<div class="pagination">
    <?php for ($i = 1; $i <= $total; $i++) { ?>    
       <?= $this->Html->link($i, ['action' => 'index', $i]) ?>
    <?php }?>
</div>