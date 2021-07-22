<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Gets a list of all customers
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function getAllCustomers()
    {
        $customers = Customer::get();

        return response()
            ->json($customers, 200);
    }

    /**
     * Gets a customer
     * 
     * @param App\Models\Customer $customer
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function getCustomer(Customer $customer)
    {
        return response()
            ->json($customer, 200);
    }

    /**
     * Creates a customer
     * 
     * @param App\Http\Requests\CreateCustomerRequest $request;
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function createCustomer(CreateCustomerRequest $request)
    {
        $customer = new Customer;
        
        $customer->name = $request->name;
        $customer->email = $request->email;

        $customer->save();
  
        return response()->json(
            [
                'message' => 'Customer created successfully'
            ],
            201
        );
    }

    /**
     * Updates a customer
     * 
     * @param App\Http\Requests\UpdateCustomerRequest $request
     * @param App\Models\Customer  $customer
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function updateCustomer(UpdateCustomerRequest $request, Customer $customer)
    {
        if ($request->name) {
            $customer->name = $request->name;
        }

        if ($request->email) {
            $customer->email = $request->email;
        }

        $customer->save();
  
        return response()->json(
            [
                'message' => 'Customer updated successfully'
            ],
            201
        );
    }

    /**
     * Deletes a customer
     * 
     * @param App\Models\Customer $customer
     * 
     * @return Illuminate\Http\JsonResponse
     */
    public function deleteCustomer(Customer $customer) {
        $customer->delete();

        return response()->json(
            [
                "message" => "Customer deleted successfully"
            ],
            202
        );
    }
}
