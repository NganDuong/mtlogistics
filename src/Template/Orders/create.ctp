<form method="post" enctype="multipart/form-data" action="/orders/create" class="order-form">
	<fieldset>
	    <legend><?= __('Customer')?></legend>
	    <div class="row">
	    	<div class="col-md-6">
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="customer_name"><?= __('Name')?></label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="customer_name" type="text" name="customer_name" value="" placeholder="<?= __('Name')?>">
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="customer_nick_name"><?= __('Nickname')?></label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="customer_nick_name" type="text" name="customer_nick_name" value="" placeholder="<?= __('Nickname')?>">
		    		</div>
	    		</p>
	    	</div>
		    <div class="col-md-6">
		    	<p class="row">
		    		<div class="col-md-4">
		    			<label for="customer_phone"><?= __('Phone')?> (*)</label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="customer_phone" type="text" name="customer_phone" value="" placeholder="<?= __('Phone')?>" required>
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="customer_address"><?= __('Address')?></label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="customer_address" type="text" name="customer_address" value="" placeholder="<?= __('Address')?>">
		    		</div>
	    		</p>
			</div>
	    </div>		    
	    <legend><?= __('Order')?></legend>
	    <div class="row">
	    	<br>
	    	<div class="col-md-6">
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="product_category_id"><?= __('Category')?> (*)</label>
		    		</div>
		    		<div class="col-md-8">
		    			<div class="custom-select">
		    				<select name="product_category_id">
						    	<?php foreach ($productCategories as $category):?>
								    <option value="<?= $category->id?>"><?= $category->name?></option>
								<?php endforeach;?>
						    </select>
		    			</div>			    			
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="product_name"><?= __('Product')?> (*)</label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="product_name" type="text" name="product_name" value="" placeholder="<?= __('Product')?>" required>
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="product_quantity"><?= __('Quantity')?> (*)</label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="product_quantity" type="number" name="product_quantity" value="" placeholder="<?= __('Quantity')?>" required>
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="order_date"><?= __('Date')?></label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="order_date" type="date" name="order_date" value="<?php echo date('Y-m-d'); ?>" placeholder="<?= __('Date')?>">
		    		</div>
	    		</p>
			</div>
			<div class="col-md-6">
				<p class="row">
		    		<div class="col-md-4">
		    			<label for="product_size"><?= __('Size')?> (*)</label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="product_size" type="text" name="product_size" value="" placeholder="<?= __('Size')?>" required>
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="product_price"><?= __('Price')?> (*)</label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="product_price" type="text" name="product_price" value="" placeholder="<?= __('Price')?>" required>
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="create_note"><?= __('Note')?></label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="create_note" type="text" name="create_note" value="" placeholder="<?= __('Note')?>">
		    		</div>
	    		</p>
	    		<p class="row">
		    		<div class="col-md-4">
		    			<label for="product_image"><?= __('Image')?></label>
		    		</div>
		    		<div class="col-md-8">
		    			<input id="product_image" type="file" name="product_image">
		    		</div>
	    		</p>			    
			</div>
		</div>
		<div class="row">
			<div class="col-md-9"></div>
			<div class="col-md-3">
				<input class="submit-button" style="float: right;" type="submit" value="<?= __('Submit')?>">
			</div>			
		</div>
  	</fieldset>
</form>