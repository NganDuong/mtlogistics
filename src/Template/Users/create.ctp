<form method="post" action="/users/create">
	<fieldset>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<label for="user_role_id"><?= __('Role')?></label>
	    	</div>
		    <div class="col-sm-6">	
			    <select name="user_role_id">
			    	<?php foreach ($roles as $role):?>
					    <option value="<?= $role->id?>"><?= $role->name?></option>
					<?php endforeach;?>
			    </select>
			</div>
	    </div>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<label for="username"><?= __('Username')?></label>
	    	</div>
		    <div class="col-sm-6">	
			    <input id="username" type="text" name="username" value="" placeholder="<?= __('Username')?>">
			</div>
	    </div>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<label for="password"><?= __('Password')?></label>
	    	</div>
		    <div class="col-sm-6">	
			    <input id="password" type="text" name="password" value="" placeholder="<?= __('Password')?>">
			</div>
	    </div>
	    <input type="submit" value="<?= __('Create')?>">
  	</fieldset>
</form>