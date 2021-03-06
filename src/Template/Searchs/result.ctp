<br>
<h3 class="center highlight-color"><?= __('Results for: ')?></h3>
<div class="center">
    <?php foreach ($conditions as $field => $value): ?>

        <?php if(gettype($value) !== 'array'){ ?>
            <label style="display: inline; background-color: #ccc"><span><?= explode(' ', explode('Orders.', $field)[1])[0]?></span> = <span><?= $value?></span></label>
        <?php } else { ?>
            <label style="display: inline; background-color: #ccc"><span><?= explode(' ', explode('Orders.', $field)[1])[0]?></span> = <span><?= implode(', ', $value) ?></span></label>
        <?php }?>
    <?php endforeach; ?>
</div>
    
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
            <td><?= $this->Html->link($order->order_code, ['controller' => 'Orders', 'action' => 'view', $order->id], ['target' => '_blank']) ?></td>
            <td><?= h($order->customer->name) ?></td>
            <td><?= $this->Html->link($order->customer->phone, ['controller' => 'Customers', 'action' => 'view', $order->customer_id], ['target' => '_blank']) ?></td>
            <td><?= h($order->product->name) ?></td>
            <td><?= h($order->price) ?></td>
            <td><?= h($order->quantity) ?></td>
            <td><?= h($order->order_date) ?></td>
            <td>
                <img src="<?= !empty($order->sent_img) ? $order->sent_img : '' ?>" alt="Photo" style="max-width:  20px;">
            </td>
            <td>
                <img src="<?= !empty($order->delivered_img) ? $order->delivered_img : '' ?>" alt="Photo" style="max-width:  20px;">
            </td>
            <td class="center">
                <?= $this->Html->link(__('Edit'), ['controller' => 'Orders', 'action' => 'update', $order->id]) ?>
                |
                <?= $this->Html->link(__('Delete'), ['controller' => 'Orders', 'action' => 'delete', $order->id]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php if(!empty($orderIds)): ?>
        <div class="print_button row">
            <?= ($print !== 0) ? $this->Html->link(__('Print'), ['action' => 'print', $orderIds, $print], ['class' => 'button button-link', 'target' => '_blank']) : '' ?>
        </div>
    <?php endif;?>

    <div class="pagination">
    </div>
</div>