<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= __('MT LOGISTICS')?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('custom.css') ?>
    <?= $this->Html->script('custom.js') ?>    

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="body-login">
	<div class="container clearfix">
		<div class="login-form">
			<div class="login-form-content">
				<h2 class="header center"><?= __('Login')?></h2>
				<form action="/users/login" method="post">
					<div class="row">
						<div class="col-md-3">
							<label><?= __('Username')?></label>
						</div>
						<div class="col-md-9">
							<input type="text" name="username" placeholder="<?= __('Username')?>">
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<label><?= __('Password')?></label>
						</div>
						<div class="col-md-9">
							<input type="password" name="password" placeholder="<?= __('Password')?>">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<input class="submit-button" type="submit" name="submit" value="<?= __('Login')?>">
						</div>						
					</div>					
				</form>
			</div>				
		</div>
	</div>
</body>
</html>