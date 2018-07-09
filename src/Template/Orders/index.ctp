<table>
    <tr>
        <th><?= __('No.')?></th>
        <th><?= __('Customer')?></th>
        <th><?= __('Customer\'s phone')?></th>
        <th><?= __('Product')?></th>
        <th><?= __('Price')?></th>
        <th><?= __('Quantity')?></th>
        <th><?= __('Order at')?></th>
        <th><?= __('Actions')?></th>
    </tr>
    <?php foreach ($orders as $order): ?>
    <tr>
        <td><?= $this->Html->link($order->order_code, ['action' => 'view', $order->id]) ?></td>
        <td><?= h($order->customer->name) ?></td>
        <td><?= $this->Html->link($order->customer->phone, ['controller' => 'Customers', 'action' => 'view', $order->customer_id]) ?></td>
        <td><?= h($order->product->name) ?></td>
        <td><?= h($order->price) ?></td>
        <td><?= h($order->quantity) ?></td>
        <td><?= h($order->order_date) ?></td>
        <td>
            <?= $this->Html->link(__('Edit'), ['action' => 'update', $order->id]) ?>
            |
            <?= $this->Html->link(__('Delete'), ['action' => 'delete', $order->id]) ?>    
        </td>
    </tr>
    <?php endforeach; ?>
</table>