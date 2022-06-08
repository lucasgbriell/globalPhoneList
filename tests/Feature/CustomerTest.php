<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    
    public function testRequiredFieldsCreating(){
        $response = $this->post('/', [
            'name' => '',
            'phone' => '',
        ]);

        $response->assertInvalid(['name', 'phone']);
    }

    public function testSuccessfulCreating(){
        
        Session::start();


        $response = $this->call('POST', '/', array(
            '_token' => csrf_token(),
            'name' => 'Test user',
            'phone' => trim('(55) 19995800456'),
        ));

        $response->assertStatus(302);
        $response->assertRedirect('/');

    }


    public function testSuccessfulDeletation(){
        $lastCustomer = Customer::orderBy('id', 'desc')->first();

        $response = $this->get('destroy/' . $lastCustomer->id);

        $response->assertStatus(302);
        $response->assertRedirect('/');

    }

    public function testPhoneValid(){
        $customer = new Customer;
        $customer->name = 'Test Phone';
        $customer->phone = '(55) 19995800456'; // Valid number regex
        $this->assertTrue($customer->isValid());
    }

    public function testPhoneInvalid(){
        $customer = new Customer;
        $customer->name = 'Test Phone';
        $customer->phone = '(55) 199958004567'; // Invalid number regex
        $this->assertTrue(!$customer->isValid());
    }
}
