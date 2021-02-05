<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Yajra\DataTables\DataTables;

class ReferalTeamController extends Controller
{
    /**
     *
     */
    public function getIndex(Request $request)
    {
        $columns = [
            0=> 'id',
            1=> 'name',
            2=> 'email',
            3=> 'country',
            4=> 'cellphone',
            5=> 'created_at',
            6=> 'leader_email',
            7=> 'leader_name',
            8=> 'sponsor_email',
            9=> 'sponsor_name',
        ];
        $totalData = User::query()->count();

        $totalFiltered = $totalData;

        if ($request->ajax()) {
            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if(empty($request->input('search.value')))
            {
                $users = User::query()->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            } else {
                $search = $request->input('search.value');
                $users =  User::query()->where('id','LIKE',"%{$search}%")
                    ->orWhere('name', 'LIKE',"%{$search}%")
                    ->orWhere('email', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
                $totalFiltered = User::query()->where('id','LIKE',"%{$search}%")
                    ->orWhere('name', 'LIKE',"%{$search}%")
                    ->orWhere('email', 'LIKE',"%{$search}%")
                    ->count();
            }
            $result = Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('country', function ($row) {
                    $jsonCountries = file_get_contents(base_path('public/assets/countries.json'));
                    $arrayCountries = json_decode($jsonCountries, true);
                    $arrayKey = array_search($row->cellphone_code, array_column($arrayCountries, 'ISD'));

                    return $arrayCountries[$arrayKey]['NAME'];
                })
                ->editColumn('cellphone', function ($row) {
                    return '+ '. $row->cellphone_code .' '. $row->cellphone;
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->toDateTimeString();
                })
                ->addColumn('leader_email', function ($row) {
                    $leader_email = '';
                    return $leader_email;
                })
                ->addColumn('leader_name', function ($row) {
                    $leader_name = '';
                    return $leader_name;
                })
                ->addColumn('sponsor_email', function ($row) {
                    $sponsor_email = '';
                    return $sponsor_email;
                })
                ->addColumn('sponsor_name', function ($row) {
                    $sponsor_name = '';
                    return $sponsor_name;
                })
                ->skipPaging()
                ->setTotalRecords($totalData)
                ->setFilteredRecords($totalFiltered)
                ->make(true);
            return $result;
        }

        return view('admin.referal-teams.index');
    }
}
