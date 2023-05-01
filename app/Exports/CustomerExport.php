<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class CustomerExport implements FromView
{
    /**
     * @return \Illuminate\Support\View
     */
    public function view(): View
    {
        return view('admin.customer.export', [
            'customers' => Customer::all()
        ]);
    }
}
