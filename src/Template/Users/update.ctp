<form method="post" action="/users/update/<?= $object->id?>">
	<fieldset>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<label for="user_role_id"><?= __('Role')?></label>
	    	</div>
		    <div class="col-sm-6">	
			    <select name="user_role_id">
			    	<?php foreach ($roles as $role):?>
			    		<option value="<?= $role->id?>" <?= ($role->id == $object->user_role_id) ? 'selected="selected"' : '';?> ><?= $role->name?></option>
					<?php endforeach;?>
			    </select>
			</div>
	    </div>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<label for="username"><?= __('Username')?></label>
	    	</div>
		    <div class="col-sm-6">	
			    <input id="username" type="text" name="username" value="<?= $object->username?>" placeholder="<?= $object->username?>">
			</div>
	    </div>
	    <div class="row">
	    	<div class="col-sm-6">
	    		<label for="password"><?= __('Password')?></label>
	    	</div>
		    <div class="col-sm-6">	
			    <input id="password" type="text" name="password" value="" placeholder="*******">
			</div>
	    </div>
	    <input type="submit" value="<?= __('Update')?>">
  	</fieldset>
</form>