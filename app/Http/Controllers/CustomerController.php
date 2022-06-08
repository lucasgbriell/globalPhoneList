<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use App\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    public $customers;
    private $data;

    public function __construct(CustomerRepository $customers){
        $this->customers = $customers;
    }

    public function index(Request $request){
        $this->data['customers'] = $this->customers->getAll($request);
        return view('index', $this->data);
    }

    public function store(CustomerRequest $request){
        $this->customers->store([
            'name'  => $request->name,
            'phone' => "{$request->countryCode} {$request->phone}"
        ]);
        return redirect()->back();
    }

    public function destroy(int $id){
        $this->customers->destroy($id);
        return redirect()->back();
    }
}
