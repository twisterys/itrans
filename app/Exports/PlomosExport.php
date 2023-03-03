<?php

namespace App\Exports;

use App\Plomo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PlomosExport implements  FromView,ShouldAutoSize
{


//    public function view(): View
//    {
//        return view('plomos.export', [
//            'plomos' => Plomo::whereNotNull('used_at')->orWhereNotNull('traiter_a')->orWhere('defaillante', 1)->get(),
//            'rest_plomos' => Plomo::where('used_at', null)->where('traiter_a', null)->where('defaillante', 0)->count()
//        ]);
//    }

    private $rapports,$rest_plomos;

    public function __construct($rapports,$rest_plomos)
    {
        $this->rapports = $rapports;
        $this->rest_plomos = $rest_plomos;
    }

    public function view(): View
    {
        return view('rapport.RapportPlomos',[
            'rapports' => $this->rapports,
            'rest_plomos'   => $this->rest_plomos
        ]);
    }



    // public function headings(): array
    // {
    //     return [
    //         '#',
    //         'Full_Name',
    //         'Bank',
    //         'RIB',
    //         'NBRS',
    //         'Salary_Type',
    //         'Salay',
    //         'Total'
    //     ];
    // }
}
