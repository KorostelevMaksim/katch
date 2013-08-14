<?
	if(getID()) {
		require_once(__ABSPATH__.'/template/admin/moduleID.php');
		die();
	}
	
if (empty($_POST)) {
		$form = new ValidFluent(array());
} elseif ($_POST['submit']=='Delete') {
	
} elseif ($_POST['submit']=='Create') {
    $form = new ValidFluent($_POST);

    $form->name('Name')->required()->alfa()->minSize(3)->maxSize(12);
		$form->name('Discription')->alfa()->maxSize(200);

    if ($form->isGroupValid()) :	
			global $db;
			$db->query('INSERT INTO Module(Module_ID,Module_Name,Module_Discription) VALUE(NULL,"'.$form->getValue('Name').'","'.$form->getValue('Discription').'")');
			redirect(getModule().'/'.getAction());
		endif;
	}
?>

<?get_header()?>
<?global $db;?>
<?$rows = $db->get_results('SELECT * FROM Module',ARRAY_A);?>
<?=(isset($status)) ? $status : '' ;?>

<?if(isset($rows)):?>
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<?foreach ($rows[0] as $key => $value):?>
					<th><?=$key?></th>
				<?endforeach;?>
			</tr>
		</thead>
		<tbody>
		<?foreach($rows as $row):?>
			<tr>
				<th><?=$row['Module_ID']?></th>
				<th><a href="<?=__BASEURL__.getModule().'/'.getAction().'/'.$row['Module_ID'].'/'?>"><?=$row['Module_Name']?></a></th>
				<th><?=$row['Module_Discription']?></th>
			</tr>
		<?endforeach;?>
		</tbody>
	</table>
	
<?endif;?>

<h2>Create new</h2>
<form class="form-horizontal" method="post" action="">
	<?$error = ($form->getError('Name')) ? 'error' : '' ; ?>
	<div class="control-group <?=$error?>">
    <label class="control-label" for="Name">Name</label>
    <div class="controls">
      <input type="text" name="Name" value="<?=$form->getValue('Name');?>" id="Name" placeholder="Name">
      <span class="help-inline"><?=$form->getError('Name');?></span>
    </div>
  </div>
  <?$error = ($form->getError('Discription')) ? 'error' : '' ; ?>
  <div class="control-group <?=$error?>">
    <label class="control-label" for="Discription">Discription</label>
    <div class="controls">
			<input type="text" name="Discription" value="<?=$form->getValue('Discription');?>" id="Discription" placeholder="Discription">
			<span class="help-inline"><?=$form->getError('Discription');?></span>
    </div>
  </div>
  <div class="form-actions">
    <input type="submit" name="submit" value="Create" class="btn btn-primary">
    <a href="<?=__BASEURL__.getModule()?>" type="button" class="btn">Cancel</a>
  </div>
</form>

<?get_footer()?>

