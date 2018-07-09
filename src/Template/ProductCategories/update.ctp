<form method="post" action="/products/categories/create">
	<fieldset>
		<div class="row">
	    	<div class="col-sm-6">
	    		<label for="id">No.</label>
	    	</div>
		    <div class="col-sm-6">	
			    <input id="id" type="text" name="id" value="<?= h($category->id) ?>" placeholder="<?= h($category->id) ?>">
			</div>
	    </div>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<label for="name">Name</label>
	    	</div>
		    <div class="col-sm-6">	
			    <input id="name" type="text" name="name" value="<?= h($category->name) ?>" placeholder="<?= h($category->name) ?>">
			</div>
	    </div>
	    <input type="submit" value="Submit">
  	</fieldset>
</form>