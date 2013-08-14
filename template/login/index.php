<?
	if (empty($_POST)) {
		$form = new ValidFluent(array());
	} elseif ($_POST['Submit']=='Submit') {
    $form = new ValidFluent($_POST);

    $form->name('Login')->required()->alfa()->minSize(1)->maxSize(5);
		$form->name('Password')->required()->alfa()->minSize(1)->maxSize(5);

    if ($form->isGroupValid()) :
			global $user;
			$user->setLogin($form->getValue('Login'))->setPassword($form->getValue('Password'))->log_in();
			
			if ($user->is_login()) {
				redirect();
			} else {
				$form->name('Error')->setError('Not found');
			}
		endif;
	}
?>
<?get_header();?>
<?=($form->getError('Error')) ? $form->getError('Error') : '' ; ?>
<form class="form-horizontal" method="post" action="">
	<?$error = ($form->getError('Login')) ? 'error' : '' ; ?>
	<div class="control-group <?=$error?>">
    <label class="control-label" for="Login">Login</label>
    <div class="controls">
      <input type="text" name="Login" value="<?=$form->getValue('Login');?>" id="Login" placeholder="Login">
      <span class="help-inline"><?=$form->getError('Login');?></span>
    </div>
  </div>
  <?$error = ($form->getError('Password')) ? 'error' : '' ; ?>
  <div class="control-group <?=$error?>">
    <label class="control-label" for="Password">Password</label>
    <div class="controls">
			<input type="text" name="Password" value="<?=$form->getValue('Password');?>" id="Password" placeholder="Password">
			<span class="help-inline"><?=$form->getError('Password');?></span>
    </div>
  </div>
  <div class="form-actions">
    <input type="submit" name="Submit" value="Submit" class="btn btn-primary">
    <a href="<?=__BASEURL__.getModule()?>" type="button" class="btn">Cancel</a>
  </div>
</form>
<?get_footer();?>