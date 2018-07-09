<form method="post" action="/products/create">
	<fieldset>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<label for="category">Category</label>
	    	</div>
		    <div class="col-sm-6">	
			    <select name="product_category_id">
			    	<?php foreach ($categories as $category):?>
					    <option value="<?= $category->id?>"><?= $category->name?></option>
					<?php endforeach;?>
			    </select>
			</div>
	    </div>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<label for="product_name">Name</label>
	    	</div>
		    <div class="col-sm-6">	
			    <input id="product_name" type="text" name="product_name" value="" placeholder="Product's name">
			</div>
	    </div>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<label for="product_size">Size</label>
	    	</div>
		    <div class="col-sm-6">	
			    <input id="product_size" type="text" name="product_size" value="" placeholder="Product's size">
			</div>
	    </div>
	    <input type="submit" value="Submit">
  	</fieldset>
</form>