<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\CustomerExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Admin\Customer\CustomerService;

class CustomerController extends Controller
{
    //
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(Request $request)
    {
        $list_customers = $this->customerService->getAll($request);
        return view('admin/customer/index', compact('list_customers'));
    }

    public function export()
    {
        return Excel::download(new CustomerExport, 'customer.xlsx');
    }
}
