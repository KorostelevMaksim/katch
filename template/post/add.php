<?
if (empty($_POST)) {
		$form = new ValidFluent(array());
} else {
    $form = new ValidFluent($_POST);

    $form->name('email')->required('you need to type someting here')->email()->minSize(5);
//    $form->name('date')->required()->date();
		$form->name('userName')->alfa()->minSize(3)->maxSize(12);
//		$form->name('choseOne')->oneOf('en:es:fr:pt:other');
//		$form->name('password1')->required()->minSize(3)->alfa();
//		$form->name('password2')->required()->equal($_POST['password1'], 'passwords didnt match');

    if ($form->isGroupValid())
			echo "Validation Passed \n";
	}
?>
<?get_header()?>

<form class="form-horizontal" method="post" action="">
  <div class="control-group">
    <label class="control-label" for="email">email</label>
    <div class="controls">
      <input type="text" name="email" value="<?=$form->getValue('email');?>" id="email" placeholder="email">
      <span class="help-inline"><?=$form->getError('email');?></span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Пароль</label>
    <div class="controls">
      <input type="password" id="inputPassword" placeholder="Пароль">
    </div>
  </div>
  <div class="form-actions">
    <input type="submit" name="submit" value="submit" class="btn btn-primary">
    <a type="button" class="btn">Отменить</a>
  </div>
</form>

<?get_footer()?>