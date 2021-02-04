<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
                    $btn = '<a href="'. route('admin.users.edit', $row->guid) .'" data-id="'.$row->guid.'" class="edit btn btn-primary btn-sm mb-1">'. trans('global.Edit') .'</a>';
                    $btn .= ' <a href="javascript:deleteUser('. "'$row->guid'" .')" data-id="'.$row->guid.'" class="btn btn-danger btn-sm mb-1">'. trans('global.Delete') .'</a>';
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
                        return '<span class="label label-warning">'. $row->roles[0]->name .'</span>';
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
}
