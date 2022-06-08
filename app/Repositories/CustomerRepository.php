<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository implements CustomerInterface{

    const PAGINATION = 10;

    public function getOne(Int $id){
        return Customer::findOrFail($id);
    }

    public function getAll($request = null){

        $status = $request->status;

        return Customer::latest()
            ->where("name", "like", "%{$request->name}%")
            ->where("phone", "like", "%{$request->countryCode}%")
            ->orderBy('name', 'asc')
            ->get()
            ->filter(function($value) use($status) {
                if($status == 'valid'){
                    return $value->isValid();
                }

                if($status == 'invalid'){
                    return !$value->isValid();
                }
                return $value;
            });
        
    }

    public function store(Array|Object $data){
        return Customer::create($data);
    }

    public function update(Int $id, Array|Object $data){
        $updateCustomer = $this->getOne($id);
        $updateCustomer->update($data);
    }
    
    public function destroy($id){
        return $this->getOne($id)->delete();
    }
}