<div class="row">
    <div class="col-sm-4">
        <span><?= __('Date')?>:</span>
        <span><?= $order['summary']['export_date']?></span>
    </div>
    <div class="col-sm-4">
        <span><?= __('Carrier')?>:</span>
        <span><?= $order['summary']['carrier']?></span>
    </div>
    <div class="col-sm-4"></div>
</div>
<table>
    <tr>
        <th><?= __('No.')?></th>
        <th><?= __('Code')?></th>
        <th><?= __('Customer\'s name')?></th>
        <th><?= __('Customer\'s phone')?></th>
        <th><?= __('Customer\'s address')?></th>
        <th><?= __('Product')?></th>
        <th><?= __('Quantity')?></th>
        <th><?= __('Amount')?></th>
        <th><?= __('Note')?></th>
    </tr>
    <?php foreach ($order['details'] as $_order): ?>
        <tbody>
            <th><?= $_order['id']?></th>
            <th><?= $_order['order_code']?></th>
            <th><?= $_order['customer_name']?></th>
            <th><?= $_order['customer_phone']?></th>
            <th><?= $_order['customer_address']?></th>
            <th><?= $_order['product']?></th>
            <th><?= $_order['quantity']?></th>
            <th><?= $_order['amount']?></th>
            <th><?= $_order['note']?></th>
        </tbody>
    <?php endforeach; ?>
</table>
<div class="row">
    <div class="col-sm-6">
        <span><?= __('Total order')?>:</span>
        <span><?= $order['summary']['totalOrder']?></span>
    </div>
    <div class="col-sm-6">
        <span><?= __('Total amout')?>:</span>
        <span><?= $order['summary']['totalAmout']?></span>
    </div>
</div>