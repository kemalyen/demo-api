<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\UserCollection;
use App\Models\Customer;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [

            'customers' => new CustomerCollection(
                Customer::select(['id', 'name', 'email', 'status', 'balance', 'created_at'])->paginate()
            )
        ]);
    }

    public function users(Customer $customer)
    {
        return Inertia::render('Customers/Users', [
            'customer' => new CustomerResource($customer),
            'users' => new UserCollection(
                $customer->users()->paginate()
            )
        ]);
    }

    public function create()
    {
        return Inertia::render('Customers/Create');
    }

    public function store(CustomerStoreRequest $request)
    {
        $customer =  new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->save();
        return Redirect::route('customers')->with('success', 'Customer created.');
    }

    public function edit(Customer $customer)
    {
        return Inertia::render('Customers/Edit', [
            'customer' => new CustomerResource($customer),
        ]);
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->status = $request->status;
        $customer->balance = $request->balance;
        $customer->save();
        return Redirect::route('customers')->with('success', 'Customer updated.');
    }
}
