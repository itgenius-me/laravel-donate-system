<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\PHelp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class PHelpController extends Controller
{
    //
    public function index(Request $request)
    {
        $totalData = PHelp::query()->count();

        $totalFiltered = $totalData;

        if ($request->ajax()) {
            $limit = $request->input('length');
            $start = $request->input('start');

            if(empty($request->input('search.value')))
            {
                $g_helps = PHelp::query()->offset($start)
                    ->limit($limit)
                    ->get();
            } else {
                $search = $request->input('search.value');
                $g_helps =  PHelp::query()->where('id','LIKE',"%{$search}%")
                    ->orWhere('email', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->get();
                $totalFiltered = PHelp::query()->where('id','LIKE',"%{$search}%")
                    ->orWhere('email', 'LIKE',"%{$search}%")
                    ->count();
            }
            $result = Datatables::of($g_helps)
                ->addIndexColumn()
                ->addColumn('leader_email', function ($row) {
                    $user = User::query()->where('email', $row->email)->get();
                    if ($user) $user_id = $user->first()->id;
                    else return "";
                    return User::getLeaderEmail($user_id);
                })
                ->addColumn('country', function ($row) {
                    $user = User::query()->where('email', $row->email)->get();
                    if ($user) $user = $user->first();
                    else return "";
                    $jsonCountries = file_get_contents(base_path('public/assets/countries.json'));
                    $arrayCountries = json_decode($jsonCountries, true);
                    $arrayKey = array_search($user->cellphone_code, array_column($arrayCountries, 'ISD'));
                    return $arrayCountries[$arrayKey]['NAME'];
                })
                ->addColumn('date_of_provide_help', function ($row) {
                    return Carbon::parse($row->created_at)->toDateTimeString();
                })
                ->addColumn('type', function ($row) {
                    if ($row->type == 1)
                        return '<span class="label label-purple">'. __('global.OrderManage.ProvideHelp.Local') .'</span>';
                    else
                        return '<span class="label label-info">'. __('global.OrderManage.ProvideHelp.Cripto') .'</span>';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1)
                        return '<span class="label label-success">'. __('global.OrderManage.ProvideHelp.Confirmed') .'</span>';
                    else
                        return '<span class="label label-warning">'. __('global.OrderManage.ProvideHelp.Unconfirmed') .'</span>';
                })
                ->addColumn('action', function ($row) {
//                    if (request()->user()->id === $row->id)
//                        $disabled = 'disabled';
//                    else
//                        $disabled = '';

                    $btn = '<a href="'. route('admin.provide-help.edit', $row->id) .'" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>';
                    $btn .= ' <button onclick="deleteProvideHelp('. "'$row->id'" .')" data-id="'.$row->id.'" class="btn btn-danger btn-sm mb-1"><i class="far fa-trash-alt"></i></button>';
                    $btn .= '<form id="deleteForm'. $row->id .'" action="'. route('admin.provide-help.destroy', $row->id) .'" method="POST" style="display: none">
                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <input type="hidden" name="_method" value="DELETE">
                    @method("DELETE")
                    </form>';

                    return $btn;
                })
                ->skipPaging()
                ->setTotalRecords($totalData)
                ->setFilteredRecords($totalFiltered)
                ->rawColumns(['status', 'action', 'type'])
                ->make(true);
            return $result;
        }

        return view('admin.provide-help.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $emails = User::all()->pluck('email');
        $currencies = Currency::query()->select('currency')->where("currency", '<>', '')->groupBy('currency')->get();
        return view('admin.provide-help.create', compact('emails', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['exists:users,email', 'required'],
            'amount' => ['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
            'currency' => ['required'],
        ], [
            'amount.regex' => 'The :attribute should be double',
        ]);
        $validated['type'] = Currency::query()->where('currency', $request->currency)->get()->first()->type;
        PHelp::create($validated);

        return redirect('/admin/provide-help');
    }

    /**
     * Show the form for editing a existing resource.
     *
     */
    public function edit($id)
    {
        $emails = User::all()->pluck('email');
        $pHelp = PHelp::query()->find($id);
        $currencies = Currency::query()->select('currency')->where("currency", '<>', '')->groupBy('currency')->get();
        return view('admin.provide-help.edit', compact('emails', 'pHelp', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $pHelp = PHelp::query()->find($id);
        $validated = $request->validate([
            'email' => ['exists:users,email', 'required'],
            'amount' => ['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
            'currency' => ['required'],
        ], [
            'amount.regex' => 'The :attribute should be double',
        ]);
        $validated['type'] = Currency::query()->where('currency', $request->currency)->get()->first()->type;
        $pHelp->update($validated);

        return redirect('/admin/provide-help');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $pHelp = PHelp::query()->find($id);
        $pHelp->delete();

        return redirect('/admin/provide-help');
    }

}
