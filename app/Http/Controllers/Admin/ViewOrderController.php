<?php

namespace App\Http\Controllers\Admin;

use App\Models\CreateOrder;
use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use DateTime;

class ViewOrderController extends Controller
{
    //
    public function index(Request $request) {
        $currencies = Currency::all();

        if ($request->ajax()) {
            $currency = strval($request->columns[6]['search']['value']);
            $status = strval($request->columns[7]['search']['value']);

            $totalData = CreateOrder::query();
            if ($currency !== "-1")
                $totalData = $totalData->where('create_orders.currency', '=', $currency);
            if ($status !== "-1")
                $totalData = $totalData->where('create_orders.status', '=', $status);
            $totalData = $totalData->count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');


            $orders = CreateOrder::query()
                ->orderByDesc('create_orders.created_at')
                ->offset($start)
                ->limit($limit);

            if ($currency !== "-1")
                $orders = $orders->where('create_orders.currency', '=', $currency);
            if ($status !== "-1")
                $orders = $orders->where('create_orders.status', '=', $status);

            if(!empty($request->input('search.value')))
            {
                $search = $request->input('search.value');
                $orders =  $orders->where(function ($query) use ($search) {
                    return $query->where('id','LIKE',"%{$search}%")
                        ->orWhere('create_orders.gh_email', 'LIKE',"%{$search}%")
                        ->orWhere('create_orders.ph_email', 'LIKE',"%{$search}%");
                });
                $totalFiltered = CreateOrder::query()
                    ->where(function ($query) use ($search) {
                    return $query->where('id','LIKE',"%{$search}%")
                        ->orWhere('create_orders.gh_email', 'LIKE',"%{$search}%")
                        ->orWhere('create_orders.ph_email', 'LIKE',"%{$search}%");
                });
                if ($currency !== "-1")
                    $totalFiltered = $totalFiltered->where('create_orders.currency', '=', $currency);
                if ($status !== "-1")
                    $totalFiltered = $totalFiltered->where('create_orders.status', '=', $status);
                $totalFiltered = $totalFiltered->count();
            }
            $orders = $orders->get();
            $result = Datatables::of($orders)
                ->addIndexColumn()
                ->addColumn('date_of_generate', function ($row) {
                    return Carbon::parse($row->created_at)->toDateTimeString();
                })
                ->addColumn('date_of_expire', function ($row) {
                    $first_date = new DateTime(Carbon::parse(date('Y-m-d h:i:s')));
                    $second_date = new DateTime(Carbon::parse($row->expired_date)->toDateTimeString());
                    $difference = $first_date->diff($second_date);
                    $result = "";
                    if ($difference->y) { $result .= $difference->format("%y years "); }
                    if ($difference->m) { $result .= $difference->format("%m months "); }
                    if ($difference->d) { $result .= $difference->format("%d days "); }
                    if ($difference->h) { $result .= $difference->format("%h hours "); }
                    if ($difference->i) { $result .= $difference->format("%i minutes "); }
                    return $result;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1)
                        return '<span class="label label-success">'. __('global.OrderManage.GetHelp.Confirmed') .'</span>';
                    else
                        return '<span class="label label-warning">'. __('global.OrderManage.GetHelp.Unconfirmed') .'</span>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm" data-whatever="@mdo">Open modal for @mdo</button>';
                    $btn .= ' <button onclick="deleteOrder('. "'$row->id'" .')" data-id="'.$row->id.'" class="btn btn-danger btn-sm mb-1"><i class="far fa-trash-alt"></i></button>';
                    $btn .= '<form id="deleteForm'. $row->id .'" action="'. route('admin.view-orders.destroy', $row->id) .'" method="POST" style="display: none">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <input type="hidden" name="_method" value="DELETE">
                    @method("DELETE")
                    </form>';

                    return $btn;
                })
                ->skipPaging()
                ->setTotalRecords($totalData)
                ->setFilteredRecords($totalFiltered)
                ->rawColumns(['status', 'action'])
                ->make(true);
            return $result;
        }
        return view("admin.view-orders.index", compact('currencies'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $order = CreateOrder::query()->find($id);
        $order->delete();

        return redirect('/admin/view-orders');
    }

}
