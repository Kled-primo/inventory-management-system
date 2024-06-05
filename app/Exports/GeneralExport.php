<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class GeneralExport implements FromView
{
    use Exportable;

    protected $q1;
    protected $q2;
    protected $q3;
    protected $q4;
    protected $year;

    public function __construct($q1, $q2, $q3, $q4, $year)
    {
        $this->q1 = $q1;
        $this->q2 = $q2;
        $this->q3 = $q3;
        $this->q4 = $q4;
        $this->year = $year;
    }


    public function view(): View
    {
        return view('forecasts._generaltable', [
            'q1' => $this->q1,
            'q2' => $this->q2,
            'q3' => $this->q3,
            'q4' => $this->q4,
            'year' => $this->year
        ]);
    }
}
