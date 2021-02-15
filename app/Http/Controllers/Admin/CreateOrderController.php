<?php

namespace App\Http\Controllers\Admin;

use App\Models\GHelp;
use App\Models\PHelp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class CreateOrderController extends Controller
{
    //
    public function index()
    {
        return view("admin.create-order.index");
    }

    public function getHelps(Request $request)
    {
        $totalData = GHelp::query()->where('status', 0)->count();
        $totalFiltered = $totalData;
//        $limit = $request->input('length');
//        $start = $request->input('start');

        if(empty($request->input('search.value')))
        {
            $g_helps = GHelp::query()->where('status', 0)
//                ->offset($start)
//                ->limit($limit)
                ->get();
        } else {
            $search = $request->input('search.value');
            $g_helps =  GHelp::query()->where('status', 0)->where('id','LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
//                ->offset($start)
//                ->limit($limit)
                ->get();
            $totalFiltered = GHelp::query()->where('status', 0)->where('id','LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->count();
        }
        $result = Datatables::of($g_helps)
            ->addIndexColumn()
            ->addColumn('ch', function ($row) {
                return '';
            })
            ->addColumn('date_of_get_help', function ($row) {
                return Carbon::parse($row->created_at)->toDateTimeString();
            })
            ->skipPaging()
            ->setTotalRecords($totalData)
            ->setFilteredRecords($totalFiltered)
            ->make(true);
        return $result;
    }
    public function provideHelps(Request $request)
    {
        $totalData = PHelp::query()->where('status', 0)->count();
        $totalFiltered = $totalData;
//        $limit = $request->input('length');
//        $start = $request->input('start');

        if(empty($request->input('search.value')))
        {
            $g_helps = PHelp::query()->where('status', 0)
//                ->offset($start)
//                ->limit($limit)
                ->get();
        } else {
            $search = $request->input('search.value');
            $g_helps =  PHelp::query()->where('status', 0)->where('id','LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
//                ->offset($start)
//                ->limit($limit)
                ->get();
            $totalFiltered = PHelp::query()->where('status', 0)->where('id','LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->count();
        }
        $result = Datatables::of($g_helps)
            ->addIndexColumn()
            ->addColumn('ch', function ($row) {
                return '';
            })
            ->addColumn('date_of_provide_help', function ($row) {
                return Carbon::parse($row->created_at)->toDateTimeString();
            })
            ->addColumn('percent', function ($row) {
                return '';
            })
            ->skipPaging()
            ->setTotalRecords($totalData)
            ->setFilteredRecords($totalFiltered)
//            ->rawColumns(['status', 'action', 'type'])
            ->make(true);
        return $result;
    }
}
