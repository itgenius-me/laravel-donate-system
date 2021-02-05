<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ReferalTeamController extends Controller
{
    /**
     * 
     */
    public function getIndex(Request $request)
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

        return view('admin.referal-teams.index', compact('users'));
    }
}
