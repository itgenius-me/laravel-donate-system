<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Exception;

class UserController extends Controller
{
    /**
     * 
     */
    public function __contruct(Request $request)
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        if ($request->ajax()) {
            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if (request()->user()->id === $row->id)
                        $disabled = 'disabled';
                    else
                        $disabled = '';

                    if ($row->activated)
                        $btn = '<button onclick="blockOrUnBlockUser('. "'$row->guid'" .');" data-id="'.$row->guid.'" class="edit btn btn-success btn-sm mb-1 mr-1" '. $disabled .'><i class="fas fa-cog"></i> '. trans('global.UserManage.activated') .'</button>';
                    else
                        $btn = '<button onclick="blockOrUnBlockUser('. "'$row->guid'" .');" data-id="'.$row->guid.'" class="edit btn btn-warning btn-sm mb-1 mr-1" '. $disabled .'><i class="fas fa-cog"></i> '. trans('global.UserManage.inactivated') .'</button>';
                        
                    $btn .= '<a href="'. route('admin.users.edit', $row->guid) .'" data-id="'.$row->guid.'" class="edit btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>';
                    $btn .= ' <button onclick="deleteUser('. "'$row->guid'" .')" data-id="'.$row->guid.'" class="btn btn-danger btn-sm mb-1" '. $disabled .'><i class="far fa-trash-alt"></i></button>';
                    $btn .= '<form id="deleteForm'. $row->guid .'" action="'. route('admin.users.destroy', $row->guid) .'" method="POST" style="display: none">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <input type="hidden" name="_method" value="DELETE">
                    @method("DELETE")
                    </form>';

                    return $btn;
                })
                ->addColumn('country', function ($row) {
                    $jsonCountries = file_get_contents(base_path('public/assets/countries.json'));
                    $arrayCountries = json_decode($jsonCountries, true);
                    $arrayKey = array_search($row->cellphone_code, array_column($arrayCountries, 'ISD'));
                    
                    return $arrayCountries[$arrayKey]['NAME'];
                })
                ->addColumn('role', function ($row) {
                    if ($row->roles[0]->name === 'Admin')
                        return '<span class="label label-success">'. $row->roles[0]->name .'</span>';
                    else
                        return '<span class="label label-info">'. $row->roles[0]->name .'</span>';
                })
                ->editColumn('cellphone', function ($row) {
                    return '+ '. $row->cellphone_code .' '. $row->cellphone;
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->toDateTimeString();
                })
                ->rawColumns(['action', 'role'])
                ->make(true);
        }

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::query()->orderBy('id', 'desc')->get();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference' => [],
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'cellphone' => ['required'],
            'cellphone_code' => ['required'],
            'password' => ['required'],
            'role' => ['required']
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        $user->assignRole($validated['role']);

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($guid)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($guid)
    {
        $roles = Role::query()->orderBy('id', 'desc')->get();
        $user = User::query()->whereGuid($guid)->firstOrFail();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $guid)
    {
        $user = User::query()->whereGuid($guid)->firstOrFail();
        $validated = $request->validate([
            'reference' => [],
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,'.$user->id],
            'cellphone' => ['required'],
            'cellphone_code' => ['required'],
            'role' => ['required']
        ]);
        
        if ($request->password) {
            $validated['password'] = Hash::make($request->password);
        }
        $user->update($validated);
        $user->syncRoles($validated['role']);

        return redirect('/admin/users')
            ->with('success', trans('global.UserManage.Message.udpateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($guid)
    {
        $user = User::query()->whereGuid($guid)->firstOrFail();
        $user->delete();

        return redirect('/admin/users')
            ->with('success', trans('global.UserManage.Message.deleteSuccess'));
    }

    /**
     * 
     */
    public function postUpdateStatus(Request $request)
    {
        try {
            $user = User::query()->whereGuid($request->id)->firstOrFail();
            $user->update([
                'activated' => !$user->activated
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => trans('global.UserManage.Message.activateSuccess')
        ]);
    }
}
