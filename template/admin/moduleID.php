<?
	global $db;
	/** Получаем активные контроллеры */
	
	$moduleContollers = $db->get_results('
		SELECT cm.ControllerModule_ID, m.Module_ID, m.Module_Name, c.Controller_ID, c.Controller_Name FROM 
			Module AS m, 
			Controller AS c, 
			ControllerModule AS cm 
		WHERE 
			cm.Module_ID='.getID().' AND
			m.Module_ID = cm.Module_ID AND
			c.Controller_ID = cm.Controller_ID
		',ARRAY_A);
	
	/** Формируем массив активных ID*/
	if (isset($moduleContollers)) {
		foreach($moduleContollers as $moduleContoller):
			$ativeControllers[] = $moduleContoller['Controller_ID'];
			
			/** Если в POST нет активного ID то его нужно деактивировать в базе */
			if (isset($_POST)) {
				if (isset($_POST['contollers'])) {
					if (!in_array($moduleContoller['Controller_ID'],$_POST['contollers'])) {
						$disativeControllers[] = $moduleContoller['Controller_ID'];
					}
				} else {
					$disativeControllers[] = $moduleContoller['Controller_ID'];
				}
			}
		endforeach;
	} else {
		$ativeControllers[] = '';
	}
	
	if (isset($_POST['ActivateControllerByModule'])) {
		
		if (isset($_POST['contollers'])) {
			foreach ($_POST['contollers'] as $value) {
				$ControllerModule_ID = $db->get_var('SELECT ControllerModule_ID FROM ControllerModule WHERE Module_ID='.getID().' AND Controller_ID='.$value);
				if (!isset($ControllerModule_ID)) {
					$db->query('INSERT INTO ControllerModule(ControllerModule_ID,Module_ID,Controller_ID) VALUE(NULL,'.getID().','.$value.')');
				}
			}
		}
		
		if (isset($disativeControllers)) {
			foreach ($disativeControllers as $value) {
				$ControllerModule_ID = $db->get_var('SELECT ControllerModule_ID FROM ControllerModule WHERE Module_ID='.getID().' AND Controller_ID='.$value);
				$Flag = $db->get_var('SELECT Role_ID FROM RoleAccessModule WHERE ControllerModule_ID='.$ControllerModule_ID);
				if (!isset($Flag)) {
					$db->query('DELETE FROM ControllerModule WHERE Module_ID='.getID().' AND Controller_ID='.$value.' AND ControllerModule_ID='.$ControllerModule_ID);
				}
			}
		}
		
		redirect(getModule().'/'.getAction().'/'.getID().'/');
	}
	
?>

<?get_header()?>
		<?//pre($moduleContollers);?>

		<?/** Получаем все контроллеры */?>
		<?$controlles = $db->get_results('SELECT Controller_ID, Controller_Name FROM Controller',ARRAY_A);?>
			
		<?/** Стоим таблицу */?>
		<?if(isset($controlles)):?>
			<table class="table">
				<thead>
					<tr>
						<th>№</th>
						<th>Controller_Name</th>
						<th>Active</th>
					</tr>
				</thead>
				<tbody>
					<?$i=1;?>
					<?foreach($controlles as $controller):?>
						<tr>
							<td><?=$i++;?></td>
							<td><?=$controller['Controller_Name']?></td>
							<td>
								<?$checked = (in_array($controller['Controller_ID'],$ativeControllers)) ? 'checked' : '' ;?>							
								<input type="checkbox" name="contollers[]" value="<?=$controller['Controller_ID']?>" <?=$checked?> form="activate" />
							</td>
						</tr>
					<?endforeach;?>
				</tbody>
			</table>
			
			<form id="activate" method="post" action="">
				<input type="hidden" name="Module_ID" value="<?=getID()?>" />
				<input type="submit" name="ActivateControllerByModule" value="Apply" class="btn btn-primary" />
				<a href="<?=__BASEURL__.getModule().'/'.getAction().'/'?>" type="button" class="btn">Cancel</a>
			</form>
		<?endif;?>
	
<?get_footer()?>