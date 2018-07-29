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
	<div class="form-print" style="padding-left: 150px; padding-right: 150px">
		<table class="table-print">
			<?php if(isset($order['customer_name'])): ?>
				<tr>
	                <td><?= __('Name')?></td>
	                <td colspan="4"><?= $order['customer_name']?></td>
	            </tr>
            <?php endif ?>
            <?php if(isset($order['customer_phone'])): ?>
				<tr>
	                <td><?= __('Phone')?></td>
	                <td colspan="4" style="font-size: 20pt"><?= $order['customer_phone']?></td>
	            </tr>
            <?php endif ?>
            <?php if(isset($order['customer_address'])): ?>
				<tr>
	                <td><?= __('Address')?></td>
	                <td colspan="4" style="font-size: 20pt"><?= $order['customer_address']?></td>
	            </tr>
            <?php endif ?>
            <?php if(isset($order['product_info'])): ?>
				<tr>
	                <td><?= __('Product')?></td>
	                <td colspan="4"><?= $order['product_info']?></td>
	            </tr>
            <?php endif ?>
            <?php if(isset($order['amount'])): ?>
				<tr>
	                <td><?= __('Collect')?></td>
	                <td colspan="4" style="font-size: 20pt"><?= $order['amount']?></td>
	            </tr>
            <?php endif ?>
		</table>
	</div>
</body>