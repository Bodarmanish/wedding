<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\UserRoleModel;
use Session;
use DB;


class RoleController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest');
	}

	public function index()
	{
		$data['title'] = 'Role List';
		$data['all_roles'] = UserRoleModel::where('deleted_at',NULL)->orderBy('id','DESC')->get();

		return view('admin.list_roles')->with($data);
	}

	public function create()
	{
		$data['title'] = 'Create Role';

		return view('admin.add_role')->with($data);
	}

	public function save(Request $req)
	{
		// echo Session::get('lgn_id');
		// return;
		$role_name = ucwords(trim($req->role_name));

		$check_role = UserRoleModel::where('role_type', $role_name)->where('deleted_at', '=', NULL)->exists(); 
		//also use doesntExist()

		// dd($check_role);

		if ($check_role == 'true') 
		{
			return response()->json(['status' => 'role_exist']);
		} 
		else 
		{

			$role = new UserRoleModel();

			$role->role_type = $role_name;
			$role->created_by = Session::get('lgn_id');
			$role->created_at = date('Y-m-d H:i:s');
			$role->save();

			if($role)
			{
				return response()->json(['status' => 'success']);
			}
			else
			{
				return response()->json(['status' => 'error']);
			}
		}

		// return view('admin.add_role')->with($data);
	}

	public function edit($id) {
		$data['title'] = 'Edit Role';
		$data['edit'] = UserRoleModel::where('id',$id)->where('deleted_at',NULL)->first();

		// echo "<pre>";
		// dd($data['edit']);

		return view('admin.add_role')->with($data);
	}

	public function update(Request $req) {

		$role_id = $req->role_id;
		$role_name = ucwords(trim($req->role_name));

		$check_role = UserRoleModel::where('role_type', $role_name)->where('id','!=',$role_id)->where('deleted_at', '=', NULL)->exists();

		if ($check_role == 'true') 
		{
			return response()->json(['status' => 'role_exist']);
		} 
		else 
		{

			$update = DB::table('user_roles')
			->where('id', $role_id)
			->update([
				'role_type' => $role_name,
				'updated_by' => Session::get('lgn_id'),
				'updated_at' => date('Y-m-d H:i:s'),
			]);

			if($update)
			{ 
				return response()->json(['status' => 'success']);
			}
			else
			{
				return response()->json(['status' => 'error']);
			}
		}

	}

	public function delete(Request $req)
	{
		$delete_role = DB::table('user_roles')
		->where('id', $req->role_id)
		->update([
			'deleted_by' => Session::get('lgn_id'),
			'deleted_at' => date('Y-m-d'),
		]);

		if($delete_role)
		{ 
			return response()->json(['status' => 'success']);
		}
		else
		{
			return response()->json(['status' => 'error']);
		}
	}

	public function permission($id) {

		$data['title'] = 'Permission';
		$data['role_id'] = $id;
		$data['all_modules'] = DB::table('module_master')->orderBy('module_name')->get();
		$data['role_modules'] = DB::table('module_master as mm')
		->leftJoin('module_child as mc', 'mm.id', '=' ,'mc.module_master_id')
		->where('mc.role_id',$id)
		->where('mm.is_display', 1)
		->where('mc.status', 1)
		->where('mc.is_delete', 0)
		->select('mm.id','mm.action_name')
		->get();
		$data['role_dedtails'] = DB::table('user_roles')->where('id',$id)->where('deleted_at',NULL)->first();
		// $data['one_user_details'] = 

		// echo "<pre>";
		// dd($data['all_modules']);

		return view('admin.permission')->with($data);

	}

	public function permission_store(Request $req) {

		$role_id = $req->role_id;
		// echo "<br>";
		$module_master_id_arr = $req->module_master_id_arr;
		$status_arr = $req->status_arr;
		// echo count($module_master_id_arr);
		// echo "<br>";
		// echo count($status_arr);
		// return;

		// dd($status_arr);

		foreach ($module_master_id_arr as $key => $module_master_id) {

			$permission_data = DB::table('module_child')
			->where('role_id',$role_id)
			->where('module_master_id',$module_master_id)
			->where('is_delete', 0)
			->get()->toArray();

			// dd($permission_data);

			if (empty($permission_data)) {
				$media_id = DB::table('module_child')->insertGetId(
					[
						'role_id' => $role_id,
						'module_master_id' => $module_master_id,
						'status' => $status_arr[$key],
					]
				);

				// if ($media_id) {
				// 	return response()->json(['status' => 'success']);
				// } else {
				// 	return response()->json(['status' => 'error']);
				// }

			} else {
				DB::table('module_child')
				->where('role_id',$role_id)
				->where('module_master_id',$module_master_id)
				->update([
					'status' => $status_arr[$key],
				]);

			}

		}
		return response()->json(['status' => 'success']);

	}

	//sidebar query

	function get_all_permissions($role_id) {
        // $this->db->select('up.*,mc.module_name,mc.table_name,mc.group_id');
        // $this->db->from('user_role_permissions up');
        // $this->db->join('module_child mc', 'up.child_module_id = mc.id');
        // $this->db->where('up.user_role_id', $role_id);
        // $this->db->order_by('group_id', 'asc');
        // return $this->db->get()->result();

        $module_data = DB::table('module_child as mc')
        ->Join('module_master as mm','mm.id','=','mc.module_master_id')
        ->where('mc.role_id',$role_id)
        ->where('mc.status',1)
        ->get();
        
        return $module_data;

    }

}