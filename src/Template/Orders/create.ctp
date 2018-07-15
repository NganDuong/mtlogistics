<form method="post" enctype="multipart/form-data" action="/orders/create">
	<fieldset>
	    <legend><?= __('Customer')?></legend>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<p>
			    	<label for="customer_name"><?= __('Name')?></label>
				    <input id="customer_name" type="text" name="customer_name" value="" placeholder="<?= __('Name')?>">
			    </p>
			    <p>
			    	<label for="customer_nick_name"><?= __('Nickname')?></label>
				    <input id="customer_nick_name" type="text" name="customer_nick_name" value="" placeholder="<?= __('Nickname')?>">
			    </p>
	    	</div>
		    <div class="col-sm-6">	
			    <p>
			    	<label for="customer_phone"><?= __('Phone')?> (*)</label>
				    <input id="customer_phone" type="text" name="customer_phone" value="" placeholder="<?= __('Phone')?>" required>
			    </p>
			    <p>
			    	<label for="customer_address"><?= __('Address')?></label>
				    <input id="customer_address" type="text" name="customer_address" value="" placeholder="<?= __('Address')?>">
			    </p>
			</div>
	    </div>		    
	    <legend><?= __('Order')?></legend>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<p>
			    	<label for="product_category_id"><?= __('Category')?> (*)</label>
				    <select name="product_category_id">
				    	<?php foreach ($productCategories as $category):?>
						    <option value="<?= $category->id?>"><?= $category->name?></option>
						<?php endforeach;?>
				    </select>
			    </p>
			    <p>
			    	<label for="product_name"><?= __('Product')?> (*)</label>
				    <input id="product_name" type="text" name="product_name" value="" placeholder="<?= __('Product')?>" required>
			    </p>
			    <p>
			    	<label for="product_quantity"><?= __('Quantity')?> (*)</label>
				    <input id="product_quantity" type="number" name="product_quantity" value="" placeholder="<?= __('Quantity')?>" required>
			    </p>			    
			    <p>
			    	<label for="order_date"><?= __('Date')?></label>
				    <input id="order_date" type="date" name="order_date" value="<?php echo date('Y-m-d'); ?>" placeholder="<?= __('Date')?>">
			    </p>
			</div>
			<div class="col-sm-6">
			    <p>
			    	<label for="product_size"><?= __('Size')?> (*)</label>
				    <input id="product_size" type="text" name="product_size" value="" placeholder="<?= __('Size')?>" required>
			    </p>
			    <p>
			    	<label for="product_price"><?= __('Price')?> (*)</label>
				    <input id="product_price" type="text" name="product_price" value="" placeholder="<?= __('Price')?>" required>
			    </p>
			    <p>
			    	<label for="create_note"><?= __('Note')?></label>
				    <input id="create_note" type="text" name="create_note" value="" placeholder="<?= __('Note')?>">
			    </p>
			    <p>
			    	<label for="product_image"><?= __('Image')?></label>
				    <input id="product_image" type="file" name="product_image">
			    </p>			    
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6"></div>
			<div class="col-sm-6">
				<input style="float: right;" type="submit" value="<?= __('Submit')?>">
			</div>			
		</div>
  	</fieldset>
</form>