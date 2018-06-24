<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller {

    public function index () {
        return Client::where('deleted', 0)
            ->orderBy('id', 'asc')->get()
        ;
    }

    public function create (Request $request) {
        $birth_date = request('birth_date');
        return Client::create([
            'name' => request('name'),
            'lastname' => request('lastname'),
            'passport' => request('passport'),
            'address' => request('address'),
            'phone' => request('phone'),
            'postal_code' => request('postal_code'),
            'age' => request('age'),
            'birth_date' => $birth_date,
            'sex' => request('sex'),
        ]);
    }

    public function delete ($id) {
        $client = Client::findOrFail($id);
        $client->deleted = true;
        $client->save();
    }

    public function edit (Request $request) {
        $client = Client::findOrFail($request->id);
        $birth_date = request('birth_date');
        $client->name = request('name');
        $client->lastname = request('lastname');
        $client->passport = request('passport');
        $client->address = request('address');
        $client->phone = request('phone');
        $client->postal_code = request('postal_code');
        $client->age = request('age');
        $client->birth_date = $birth_date;
        $client->sex = request('sex');
        $client->save();
    }
}
