<?
	global $db;
	
	$arrayActiveControllers = $db->get_results('SELECT ControllerModule_ID FROM RoleAccessModule WHERE Role_ID='.getID(),ARRAY_A);
	
	if (isset($arrayActiveControllers)) {
		foreach ($arrayActiveControllers as $activeController) {
			$activeControllers[$activeController['ControllerModule_ID']] = $activeController['ControllerModule_ID'];
		}
	} else {
		$activeControllers = array();
	}
	
//	pre($_POST);
//	pre($activeControllers);
	
	if (isset($_POST['ActivateControllerForRole'])) {
		if (isset($activeControllers)) {
			foreach ($activeControllers as $activeController) {
				$db->query('DELETE FROM RoleAccessModule WHERE Role_ID='.getID().' AND ControllerModule_ID='.$activeController);
			}
		}
		if (isset($_POST['ControllerModule_ID'])) {
			foreach ($_POST['ControllerModule_ID'] as $ControllerModule_ID) {
				$flag = $db->get_var('SELECT Role_ID FROM RoleAccessModule WHERE Role_ID='.getID().' AND ControllerModule_ID='.$ControllerModule_ID);
				if (!$flag) {
					$db->query('INSERT INTO RoleAccessModule(Role_ID,ControllerModule_ID) VALUE('.getID().','.$ControllerModule_ID.')');
				}
			}
		}
		redirect(getModule().'/'.getAction().'/'.getID().'/');
	}
	
?>

<?get_header()?>

<?
	
	$ControllersAndModules = $db->get_results('SELECT * FROM ControllerModule ORDER BY Module_ID',ARRAY_A);
	$ArrayControllers = $db->get_results('SELECT * FROM Controller ORDER BY Controller_ID',ARRAY_A);
	foreach ($ArrayControllers as $value) {
		$Controllers[$value['Controller_ID']] = $value['Controller_Name'];
	}
	$ArrayModules = $db->get_results('SELECT * FROM Module ORDER BY Module_ID',ARRAY_A);	
	
	foreach ($ArrayModules as $value) {
		$Modules[$value['Module_ID']] = $value['Module_Name'];
	}

?>

	<?if(isset($ControllersAndModules) && isset($Controllers) && isset($Modules)):?>
	
		<table class="table">
			<thead>
				<tr>
					<th>№</th>
					<th>Модуль</th>
					<th>Контроллер</th>
					<th>Статус</th>
				</tr>
			</thead>
			<tbody>
				<?$i=1?>
				<?foreach ($ControllersAndModules as $ControllersAndModule) {?>
					<tr>
						<td><?=$i++?></td>
						<td><?=$Modules[$ControllersAndModule['Module_ID']]?></td>
						<td><?=$Controllers[$ControllersAndModule['Controller_ID']]?></td>
						<?$checked=(in_array($ControllersAndModule['ControllerModule_ID'],$activeControllers)) ? 'checked' : '' ;?>
						<td><input type="checkbox" name="ControllerModule_ID[]" value="<?=$ControllersAndModule['ControllerModule_ID']?>" form="activate" <?=$checked?> /></td>
					</tr>
				<?}?>
			</tbody>
		</table>
		
		<form id="activate" method="post" action="">
			<input type="hidden" name="Role_ID" value="<?=getID()?>" />
			<input type="submit" name="ActivateControllerForRole" value="Apply" class="btn btn-primary" />
			<a href="<?=__BASEURL__.getModule().'/'.getAction().'/'?>" type="button" class="btn">Cancel</a>
		</form>
	
	<?endif;?>


<?get_footer()?>