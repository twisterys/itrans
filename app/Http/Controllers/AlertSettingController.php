<?php

namespace App\Http\Controllers;

use App\AlertSetting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AlertSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = AlertSetting::get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $editLink = route('alert-setting.edit',$row->id);
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm">Modifier</a>';
                return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }


        return view('alert_settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AlertSetting  $alertSetting
     * @return \Illuminate\Http\Response
     */
    public function show(AlertSetting $alertSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AlertSetting  $alertSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(AlertSetting $alertSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AlertSetting  $alertSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlertSetting $alertSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AlertSetting  $alertSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlertSetting $alertSetting)
    {
        //
    }
}
