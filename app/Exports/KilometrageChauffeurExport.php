<?php

namespace App\Exports;

use App\Dossier;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KilometrageChauffeurExport implements FromView, ShouldAutoSize
{
    private $rapports;

    public function __construct($rapports)
    {
        //dd($rapports);
        $this->rapports = $rapports;
    }

   public function view(): View
   {
        return view('rapport.RapportKilometrageChauffeur',[ 
            'rapports' => $this->rapports
        ]);
   }
}
