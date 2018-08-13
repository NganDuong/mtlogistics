<br>
<h3 class="center highlight-color"><?= __('List of orders')?></h3>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th><?= __('No.')?></th>
            <th><?= __('Customer')?></th>
            <th><?= __('Customer\'s phone')?></th>
            <th><?= __('Product')?></th>
            <th><?= __('Price')?></th>
            <th><?= __('Quantity')?></th>
            <th><?= __('Order at')?></th>
            <th><?= __('Sent')?></th>
            <th><?= __('Delivered')?></th>
            <th><?= __('Actions')?></th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $this->Html->link($order->order_code, ['action' => 'view', $order->id]) ?></td>
            <td><?= h($order->customer->name) ?></td>
            <td><?= $this->Html->link($order->customer->phone, ['controller' => 'Customers', 'action' => 'view', $order->customer_id]) ?></td>
            <td><?= h($order->product->name) ?></td>
            <td class="center"><?= h($order->price) ?></td>
            <td class="center"><?= h($order->quantity) ?></td>
            <td class="center"><?= h($order->order_date) ?></td>
            <td class="center">
                <img src="<?= !empty($order->sent_img) ? $order->sent_img : '' ?>" alt="Photo">
            </td>
            <td class="center">
                <img src="<?= !empty($order->delivered_img) ? $order->delivered_img : '' ?>" alt="Photo">
            </td>
            <td class="center">
                <?= $this->Html->link(__('Edit'), ['action' => 'update', $order->id]) ?>
                |
                <?= $this->Html->link(__('Delete'), ['action' => 'delete', $order->id]) ?>    
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div class="pagination">
        <?= ($prev > 0) ? $this->Html->link(__('< prev'), ['action' => 'index', $prev]) : '' ?>
        <?= ($next > 0) ? $this->Html->link(__('next >'), ['action' => 'index', $next]) : '' ?>
    </div>
</div>