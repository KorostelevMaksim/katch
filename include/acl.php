<?
	
	class acl{
	
		protected $access;
		protected $role_id;
		
		function  __construct($role_id) {
			global $db;
			$this->role_id = (int) $role_id;
			$arrayControllerModule_ID = $db->get_results('SELECT ControllerModule_ID FROM RoleAccessModule WHERE Role_ID='.$this->role_id,ARRAY_A);
			
			$ControllerModule_Name = $db->get_results('SELECT cm.ControllerModule_ID, m.Module_Name,c.Controller_Name FROM ControllerModule AS cm, Module AS m, Controller AS c WHERE c.Controller_ID = cm.Controller_ID AND cm.Module_ID=m.Module_ID',ARRAY_A);
			
			if (isset($arrayControllerModule_ID) && isset($ControllerModule_Name)) {
				foreach ($arrayControllerModule_ID as $value) {
					$ControllerModule_ID[] = $value['ControllerModule_ID'];
				}
				
				foreach ($ControllerModule_Name as $value) {
					if (in_array($value['ControllerModule_ID'], $ControllerModule_ID)) {
						$this->access[strtolower($value['Module_Name'])][] = strtolower($value['Controller_Name']);
					}
					
				}
				
			}
		}
		
		public function is_allow($module,$action = 'index') {
			if (isset($this->access[strtolower($module)])) {
				foreach ($this->access[strtolower($module)] as $value) {
					if (strtolower($value) === strtolower($action)) {
						return TRUE;
					}
				}
			}	
			return FALSE;
		}
		
	}
	
?>