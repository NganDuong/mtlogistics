<form method="post" action="/customers/update/<?= $customer->id?>">
	<fieldset>
		<div class="row">
	    	<div class="col-sm-6">
	    		<label for="name"><?= __('Name')?></label>
	    	</div>
		    <div class="col-sm-6">	
			    <input id="name" type="text" name="name" value="<?= h($customer->name) ?>" placeholder="<?= h($customer->name) ?>">
			</div>
	    </div>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<label for="nickname"><?= __('Nickname')?></label>
	    	</div>
		    <div class="col-sm-6">	
			    <input id="nickname" type="text" name="nickname" value="<?= h($customer->nickname) ?>" placeholder="<?= h($customer->nickname) ?>">
			</div>
	    </div>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<label for="phone"><?= __('Phone number')?></label>
	    	</div>
		    <div class="col-sm-6">	
			    <input id="phone" type="text" name="phone" value="<?= h($customer->phone) ?>" placeholder="<?= h($customer->phone) ?>">
			</div>
	    </div>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<label for="address"><?= __('Address')?></label>
	    	</div>
		    <div class="col-sm-6">	
			    <input id="address" type="text" name="address" value="<?= h($customer->address) ?>" placeholder="<?= h($customer->address) ?>">
			</div>
	    </div>
	    <input type="submit" value="Submit">
  	</fieldset>
</form>