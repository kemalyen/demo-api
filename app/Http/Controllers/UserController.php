<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function create()
    {
        $customers = Customer::all();
        return Inertia::render('Users/Create', 
        ['customers' => new CustomerCollection($customers)]);
    }

    public function store(UserStoreRequest $request)
    {
        $user =  new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->customer_id = $request->customer_id;
        $user->password = Str::password();
        $user->save();
        return Redirect::route('users.edit', $user->id)->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        $customers = Customer::all();
        return Inertia::render('Users/Edit', [
            'customers' => new CustomerCollection($customers),
            'user' => new UserResource($user),
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
