<?php

namespace App\Helpers;
use DB;
use Session;

class Helper
{
	
	public static function module_permissions($role_id,$module_name) {
		$module_data = DB::table('module_child as mc')
		->Join('module_master as mm','mm.id','=','mc.module_master_id')
		->where('mc.role_id',Session::get('role_id'))
		->where('mm.module_name',$module_name)
		->get()->toArray();

		$module_permission = array();
		foreach ($module_data as $key => $module) {
			if($module->status == 1){
				$module_permission[$module->action_name] = $module->status;
			}
		}
		return $module_permission;
	}

}