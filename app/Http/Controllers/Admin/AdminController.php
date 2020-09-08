<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Helper;
use Session;
use DB;
use App\UserModel;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('guest');
    }



    
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['users'] = DB::table('admins')
        ->select('*')
        ->get();
        return view('admin.adminDashboard')->with($data);
    }

    public function list_users()
    {
        $all_users['title'] = 'Users List';
        $all_users['module_permission'] = Helper::module_permissions(Session::get('role_id'),'users');
        // echo "<pre>";
        // print_r($data['module_permission']);
        // return;
        
        $all_users['all_user'] = DB::table('admins')
        ->join('user_roles','user_roles.id','admins.role_id')
        ->select('admins.*','user_roles.role_type as role_type')
        ->where([['admins.deleted_at',NULL]])
        ->get();

        return view('admin.list_users')->with($all_users);
    }

    public function add_users()
    {

        $module_data = Helper::module_permissions(Session::get('role_id'),'users');
        // echo "<pre>";
        // print_r($module_data);
        // return;

        if(isset($module_data['create'])){
            $UserRoles['title'] = 'Add User';

            $UserRoles['all_roles'] = DB::table('user_roles') 
            ->select('*')
            ->where('deleted_at', NULL)
            ->get();

            return view('admin.add_user')->with($UserRoles);
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    
    public function save_user(Request $request)
    {
        $email = trim($request->email);
        $role = trim($request->role);
        
        $check_user = DB::table('admins')
        ->where('email', '=', $email)
        ->where('role_id', '=', $role)
        ->where('deleted_at', '=', NULL)
        ->exists(); //also use doesntExist()
        
        if ($check_user >= 1) 
        {
            return response()->json(['status' => 'user_exist']);
        } 
        else 
        {

            $add_user = new UserModel();

            $add_user->name = ucwords(trim($request->full_name));
            $add_user->role_id = $request->role;
            $add_user->email = strtolower($request->email);
            $add_user->mobile = trim($request->mobile);
            $add_user->password = trim(md5($request->password));
            $add_user->created_by = Session::get('lgn_id');
            $add_user->updated_at = NULL;
            $add_user->created_at = date('Y-m-d');
            $add_user->save();

            if($add_user)
            {
                return response()->json(['status' => 'success']);
            }
            else
            {
                return response()->json(['status' => 'error']);
            }
        }
    }


    public function edit_user(Request $request, $id)
    {
        $module_data = Helper::module_permissions(Session::get('role_id'),'users');
        if(isset($module_data['edit'])){
            $data['title'] = "Edit User";

            $data['all_roles'] = DB::table('user_roles') 
            ->select('*')
            ->where('deleted_at', NULL)
            ->get();

            $data['users'] = DB::table('admins')
            ->where('id',$id)
            ->where('deleted_at', NULL)
            ->first();

            return view('admin.edit_user')->with($data);
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function update_user(Request $request)
    {
        $update_user = DB::table('admins')
        ->where('id', $request->user_id)
        ->update([
            'name' => ucwords(trim($request->full_name)),
            'role_id' => $request->role,
            'email' => trim($request->email),
            'mobile' => trim($request->mobile),
            'password' => trim(md5($request->password)),
            'updated_by' => Session::get('lgn_id'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        if($update_user)
        { 
            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }

    public function delete_user(Request $request)
    {
        $delete_user = DB::table('admins')
        ->where('id', $request->user_id)
        ->update([
            'deleted_by' => Session::get('lgn_id'),
            'deleted_at' => date('Y-m-d'),
        ]);

        if($delete_user)
        { 
            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }


    public function edit_profile()
    {
        $data['title'] = 'User Profile';

        $data['all_roles'] = DB::table('user_roles') 
        ->select('*')
        ->where('deleted_at', NULL)
        ->get();

        $data['users'] = DB::table('admins')
        ->where('id',Session::get('lgn_id'))
        ->where('deleted_at', NULL)
        ->first();

        return view('admin.profile')->with($data);
    }


    public function update_profile(Request $request)
    {
        $update_profile = DB::table('admins')
        ->where('id', Session::get('lgn_id'))
        ->update([
            'name' => ucwords(trim($request->full_name)),
            'email' => trim($request->email),
            'mobile' => trim($request->mobile),
            'password' => trim(md5($request->password)),
            'updated_by' => Session::get('lgn_id'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        if($update_profile)
        { 
            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }

        // return view('admin.profile')->with($data);
    }

    public function change_password()
    {
        $data['title'] = 'Change Password';

        return view('admin.changepassword')->with($data);
    }


    public function update_password(Request $request)
    {

        $check_pwd = DB::table('admins')
        ->select('*')
        ->where('id', Session::get('lgn_id'))
        ->where('password', md5($request->old_password))
        ->doesntExist(); //also use doesntExist()
        
        if ($check_pwd) 
        {
            return response()->json(['status' => 'exist']);
            
        } 
        else 
        {
            $update_pwd = DB::table('admins')
            ->where('id', Session::get('lgn_id'))
            ->update([
                'password' => trim(md5($request->password)),
                'updated_by' => Session::get('lgn_id'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            if($update_pwd)
            { 
                return response()->json(['status' => 'success']);
            }
            else
            {
                return response()->json(['status' => 'error']);
            }
            
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
