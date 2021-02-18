<?php

namespace App\Http\Controllers\Admin;

use App\Models\CreateOrder;
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

    //
    public function generate(Request $request)
    {
        $get_help = $request->gh_ids;
        $provide_help = $request->ph_ids;

        $order = new CreateOrder;
        $order->gh_id = $get_help['id'];
        $order->gh_email = $get_help['email'];

        $order->ph_id = $provide_help['id'];
        $order->ph_email = $provide_help['email'];
        $order->ph_order_type = $provide_help['order_type'];

        return response()->json([
            'success' => $request->gh_ids,
            'sss' => $request->ph_ids,
        ]);
    }

    //
    public function generateMulti(Request $request)
    {
        $get_helps = json_decode($request->gh_ids);
        $provide_helps = json_decode($request->ph_ids);

        $result = [];
        if (sizeof($provide_helps) == 1)
        {
            $provide_help = $provide_helps[0];
            foreach ($get_helps as $get_help)
            {
                $one = [];
                $one['gh_id'] = $get_help->id;
                $one['gh_email'] = $get_help->email;

                $one['ph_id'] = $provide_help->id;
                $one['ph_email'] = $provide_help->email;
                array_push($result, $one);
            }
        }

        return response()->json([
            'success' => $request->gh_ids,
            'sss' => $request->ph_ids,
        ]);
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
            ->addColumn('remain_amount', function ($row) {
                $remain = $row->amount;

                return $remain;
            })
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
            ->addColumn('order_type', function ($row) {
                $max_order = CreateOrder::query()->where("ph_id", $row->id)->max('ph_order_type');
                return ($max_order + 1);
            })
            ->addColumn('remain_amount', function ($row) {
                $remain_amount = 0;
                $ordered_amount = CreateOrder::query()->where("ph_id", $row->id)->max('ph_order_type');
                return $remain_amount;
            })
            ->skipPaging()
            ->setTotalRecords($totalData)
            ->setFilteredRecords($totalFiltered)
            ->rawColumns(['percent'])
            ->make(true);
        return $result;
    }
}
