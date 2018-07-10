<div>
	<label style="text-align: center;"><?= __('SEARCH')?></label>
</div>

<form method="post" action="/searchs">
	<fieldset>
		<label><?= __('Order')?></label>
	    <div class="row">
	    	<div class="col-sm-3">
	    		<label for="order_no"><?= __('No.')?></label>
			    <input id="order_no" type="text" name="order_no" value="" placeholder="<?= __('No.')?>">
	    	</div>
			<div class="col-sm-3">
				<label for="product_quantity"><?= __('Quantity')?></label>
			    <input id="product_quantity" type="number" name="product_quantity" value="" placeholder="<?= __('Quantity')?>">
			</div>
			<div class="col-sm-3">
				<label for="product_price"><?= __('Price')?></label>
			    <input id="product_price" type="text" name="product_price" value="" placeholder="<?= __('Price')?>">
			</div>
			<div class="col-sm-3">
				<label for="order_date"><?= __('Date')?></label>
			    <input id="order_date" type="date" name="order_date" value="" placeholder="<?= __('Date')?>">
			</div>
	    </div>
		<label><?= __('Customer')?></label>
	    <div class="row">
	    	<div class="col-sm-3">
	    		<label for="customer_name"><?= __('Name')?></label>
			    <input id="customer_name" type="text" name="customer_name" value="" placeholder="<?= __('Name')?>">
	    	</div>
			<div class="col-sm-3">
				<label for="customer_nick_name"><?= __('Nickname')?></label>
			    <input id="customer_nick_name" type="text" name="customer_nick_name" value="" placeholder="<?= __('Nickname')?>">
			</div>
			<div class="col-sm-3">
				<label for="customer_phone"><?= __('Phone')?></label>
			    <input id="customer_phone" type="text" name="customer_phone" value="" placeholder="<?= __('Phone')?>">
			</div>
			<div class="col-sm-3">
				<label for="customer_address"><?= __('Address')?></label>
			    <input id="customer_address" type="text" name="customer_address" value="" placeholder="<?= __('Address')?>">
			</div>
	    </div>
	    <label><?= __('Product')?></label>
	    <div class="row">
	    	<div class="col-sm-4">
	    		<label for="product_size"><?= __('Size')?></label>
			    <input id="product_size" type="text" name="product_size" value="" placeholder="<?= __('Size')?>">
	    	</div>
			<div class="col-sm-4">
				<label for="product_name"><?= __('Product')?></label>
			    <input id="product_name" type="text" name="product_name" value="" placeholder="<?= __('Product')?>">
			</div>
			<div class="col-sm-4">
				<label for="product_category_id"><?= __('Category')?></label>
			    <select name="product_category_id">
			    	<?php foreach ($productCategories as $category):?>
					    <option value="<?= $category->id?>"><?= $category->name?></option>
					<?php endforeach;?>
			    </select>
			</div>
			
	    </div>
	    <input type="submit" value="<?= __('Submit')?>">
  	</fieldset>
</form>