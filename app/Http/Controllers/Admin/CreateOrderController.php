<?php

namespace App\Http\Controllers\Admin;

use App\Models\CreateOrder;
use App\Models\Currency;
use App\Models\GHelp;
use App\Models\PHelp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use DB;

class CreateOrderController extends Controller
{
    //
    public function index()
    {
        $currencies = Currency::all();
        return view("admin.create-order.index", compact('currencies'));
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

        $order->currency = $get_help['currency'];

        $percent = 0;
        if (intval($provide_help['order_type']) == 1 || intval($provide_help['order_type']) == 4) $percent = 0.1;
        if (intval($provide_help['order_type']) == 2 || intval($provide_help['order_type']) == 3) $percent = 0.4;

        $order->match_order_amount = $provide_help['amount'] * $percent;
        $order->status = 0;
        $order->proof_attachment = '';
        $order->expired_date = $current = Carbon::now()->addHours(50);
        $order->save();

        return response()->json([
            'success' => $order,
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
        $date_range = explode(" - ", strval($request->columns[3]['search']['value']));
        if (sizeof($date_range) > 1)
        {
            $start_date = trim($date_range[0]);
            $end_date = trim($date_range[1]);
        } else {
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d');
        }
        $currency = strval($request->columns[4]['search']['value']);
        $g_helps = GHelp::query()->where('status', 0)
            ->leftJoin(DB::raw('(SELECT gh_id, SUM(match_order_amount) AS ordered FROM create_orders GROUP BY gh_id) AS orders')
                , 'orders.gh_id', '=', 'g_helps.id')
            ->where('g_helps.currency', '=', $currency)
            ->where(function ($query){
                return $query->where('orders.ordered','<', DB::raw('g_helps.amount'))
                    ->orWhereNull('orders.ordered');
            })
            ->where(function ($query) use ($start_date, $end_date){
                return $query->where(DB::raw('DATE(g_helps.created_at)'),'>=', $start_date)
                    ->where(DB::raw('DATE(g_helps.created_at)'),'<=', $end_date);
            });
        if (strval($request->columns[1]['search']['value']) == "1")
        {
            $g_helps = $g_helps
                ->join(DB::raw('(SELECT reference AS email FROM (SELECT COUNT(id) cnt, reference FROM users GROUP BY reference) AS managers WHERE cnt > 4 UNION SELECT email FROM users WHERE is_manager=1) AS users')
                    , function($join){
                        return $join->on('users.email', '=', 'g_helps.email');
                    });
        }

        if(!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $g_helps = $g_helps->where(function ($query) use ($search) {
                return $query ->where('id','LIKE',"%{$search}%")
                    ->orWhere('g_helps.email', 'LIKE',"%{$search}%");
            });
        }
        $g_helps = $g_helps->get();

        $result = Datatables::of($g_helps)
            ->addIndexColumn()
            ->addColumn('remain_amount', function ($row) {
                $ordered_amount = CreateOrder::query()->where("gh_id", $row->id)->sum('match_order_amount');
                return ($row->amount - $ordered_amount);
            })
            ->addColumn('ch', function ($row) {
                return '';
            })
            ->addColumn('date_of_get_help', function ($row) {
                return Carbon::parse($row->created_at)->toDateTimeString();
            })
            ->skipPaging()
            ->make(true);
        return $result;
    }
    public function provideHelps(Request $request)
    {
        $date_range = explode(" - ", strval($request->columns[3]['search']['value']));
        if (sizeof($date_range) > 1)
        {
            $start_date = trim($date_range[0]);
            $end_date = trim($date_range[1]);
        } else {
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d');
        }

        $currency = strval($request->columns[4]['search']['value']);
        $p_helps = PHelp::query()->where('status', 0)
            ->leftJoin(DB::raw('(SELECT ph_id, SUM(match_order_amount) AS ordered FROM create_orders GROUP BY ph_id) AS orders')
                , 'orders.ph_id', '=', 'p_helps.id')
            ->where('p_helps.currency', '=', $currency)
            ->where(function ($query){
                return $query->where('orders.ordered','<', DB::raw('p_helps.amount'))
                    ->orWhereNull('orders.ordered');
            })
            ->where(function ($query) use ($start_date, $end_date){
                return $query->where(DB::raw('DATE(p_helps.created_at)'),'>=', $start_date)
                    ->where(DB::raw('DATE(p_helps.created_at)'),'<=', $end_date);
            });
        if (strval($request->columns[1]['search']['value']) == "1")
        {
            $p_helps = $p_helps
                ->join(DB::raw('(SELECT reference AS email FROM (SELECT COUNT(id) cnt, reference FROM users GROUP BY reference) AS managers WHERE cnt > 4 UNION SELECT email FROM users WHERE is_manager=1) AS users')
                    , function($join){
                        return $join->on('users.email', '=', 'p_helps.email');
                    });
        }
        if(!empty($request->input('search.value')))
        {
            $search = $request->input('search.value');
            $p_helps = $p_helps->where(function ($query) use ($search) {
                return $query ->where('id','LIKE',"%{$search}%")
                    ->orWhere('p_helps.email', 'LIKE',"%{$search}%");
            });

        }
        $p_helps = $p_helps->get();

        $result = Datatables::of($p_helps)
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
            ->addColumn('order_type_name', function ($row) {
                $max_order = CreateOrder::query()->where("ph_id", $row->id)->max('ph_order_type');
                if ($max_order + 1 == 1) return trans('global.OrderGenerate.first_10');
                else if ($max_order + 1 == 2) return trans('global.OrderGenerate.first_40');
                else if ($max_order + 1 == 3) return trans('global.OrderGenerate.second_40');
                else if ($max_order + 1 == 4) return trans('global.OrderGenerate.second_10');
            })
            ->addColumn('remain_amount', function ($row) {
                $ordered_amount = CreateOrder::query()->where("ph_id", $row->id)->sum('match_order_amount');
                return ($row->amount - $ordered_amount);
            })
            ->skipPaging()
            ->make(true);
        return $result;
    }
}
