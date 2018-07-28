<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= __('MT LOGISTICS')?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('custom.css') ?>
    <?= $this->Html->script('custom.js') ?>    

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body style="background-color: #fff">
    <div class="form-print">
        <table class="table-print">
            <tr>
                <th colspan="2"><?= __('Date')?></th>
                <th><?= $order['summary']['export_date']?></th>
                <th colspan="2"><?= __('Carrier')?></th>
                <th colspan="4"><?= $order['summary']['carrier']?></th>
            </tr>
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
            <?php $count = 1; ?>
            <?php foreach ($order['details'] as $_order): ?>
                <tr>
                    <td class="center"><?= $count++ ?></td>
                    <td class="center"><?= $_order['order_code']?></td>
                    <td><?= $_order['customer_name']?></td>
                    <td><?= $_order['customer_phone']?></td>
                    <td><?= $_order['customer_address']?></td>
                    <td><?= $_order['product']?></td>
                    <td class="center"><?= $_order['quantity']?></td>
                    <td class="center"><?= $_order['amount']?></td>
                    <td><?= $_order['note']?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6" class="center"><?= __('Total')?></td>
                <td class="center"><?= $order['summary']['totalOrder']?></td>
                <td class="center"><?= $order['summary']['totalAmout']?></td>
                <td></td>
            </tr>
        </table>
    </div>
</body>        