<?php if(isset($order['customer_name'])): ?>
	<div class="row">
		<div class="col-sm-6">
			<span><?= __('Name')?>: </span>			
		</div>
		<div class="col-sm-6">
			<span><?= $order['customer_name']?></span>
		</div>
	</div>
<?php endif ?>

<?php if(isset($order['customer_phone'])): ?>
	<div class="row">
		<div class="col-sm-6">
			<span><?= __('Phone')?>: </span>			
		</div>
		<div class="col-sm-6">
			<span><?= $order['customer_phone']?></span>
		</div>
	</div>
<?php endif ?>

<?php if(isset($order['customer_address'])): ?>
	<div class="row">
		<div class="col-sm-6">
			<span><?= __('Address')?>: </span>			
		</div>
		<div class="col-sm-6">
			<span><?= $order['customer_address']?></span>
		</div>
	</div>
<?php endif ?>

<?php if(isset($order['product_info'])): ?>
	<div class="row">
		<div class="col-sm-6">
			<span><?= __('Product')?>: </span>			
		</div>
		<div class="col-sm-6">
			<span><?= $order['product_info']?></span>
		</div>
	</div>
<?php endif ?>

<?php if(isset($order['customer_name'])): ?>
	<div class="row">
		<div class="col-sm-6">
			<span><?= __('Name')?>: </span>			
		</div>
		<div class="col-sm-6">
			<span><?= $order['customer_name']?></span>
		</div>
	</div>
<?php endif ?>

<?php if(isset($order['amount'])): ?>
	<div class="row">
		<div class="col-sm-6">
			<span><?= __('Collect')?>: </span>			
		</div>
		<div class="col-sm-6">
			<span><?= $order['amount']?></span>
		</div>
	</div>
<?php endif ?>