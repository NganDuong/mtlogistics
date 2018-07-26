<div class="padding_top"></div>
<?php if(isset($order['customer_name'])): ?>
	<div class="row print">
		<div class="col-sm-6 print_element">
			<span><?= __('Name')?>: </span>			
		</div>
		<div class="col-sm-6 print_element">
			<span><?= $order['customer_name']?></span>
		</div>
	</div>
<?php endif ?>

<?php if(isset($order['customer_phone'])): ?>
	<div class="row print">
		<div class="col-sm-6 print_element">
			<span><?= __('Phone')?>: </span>			
		</div>
		<div class="col-sm-6 print_element">
			<span><?= $order['customer_phone']?></span>
		</div>
	</div>
<?php endif ?>

<?php if(isset($order['customer_address'])): ?>
	<div class="row print">
		<div class="col-sm-6 print_element">
			<span><?= __('Address')?>: </span>			
		</div>
		<div class="col-sm-6 print_element">
			<span><?= $order['customer_address']?></span>
		</div>
	</div>
<?php endif ?>

<?php if(isset($order['product_info'])): ?>
	<div class="row print">
		<div class="col-sm-6 print_element">
			<span><?= __('Product')?>: </span>			
		</div>
		<div class="col-sm-6 print_element">
			<span><?= $order['product_info']?></span>
		</div>
	</div>
<?php endif ?>

<?php if(isset($order['customer_name'])): ?>
	<div class="row print">
		<div class="col-sm-6 print_element">
			<span><?= __('Name')?>: </span>			
		</div>
		<div class="col-sm-6 print_element">
			<span><?= $order['customer_name']?></span>
		</div>
	</div>
<?php endif ?>

<?php if(isset($order['amount'])): ?>
	<div class="row print">
		<div class="col-sm-6 print_element">
			<span><?= __('Collect')?>: </span>			
		</div>
		<div class="col-sm-6 print_element">
			<span><?= $order['amount']?></span>
		</div>
	</div>
<?php endif ?>