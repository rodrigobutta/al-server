<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{


    public function index(Request $request)
    {

        $items = User::select('id','name','email','phone','address_street','address_city','address_suite','address_zipcode')->get();

        foreach ($items as &$item) {
            $item->encodeJsonNodes();
        }

        return response()->json($items);

    }


    public function store(Request $request) // es el create del mundo real
    {

        $data = json_decode($request->getContent(), true);

        $item = new User([
          'name' => $data['name'],
          'email' => $data['email'],
          'phone' => $data['phone'],
          'address_street' => $data['address']['street'],
          'address_city' => $data['address']['city'],
          'address_suite' => $data['address']['suite'],
          'address_zipcode' => $data['address']['zipcode']
        ]);
        $item->save();

        return response()->json('Successfully added');

    }


    public function show($id)
    {

        $item = User::select('id','name','email','phone','address_street','address_city','address_suite','address_zipcode')->whereId($id)->first();

        $item->encodeJsonNodes();

        return response()->json($item);

    }


    public function update($id, Request $request)
    {

        $data = json_decode($request->getContent(), true);

        $fields = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address_street' => $data['address']['street'],
            'address_city' => $data['address']['city'],
            'address_suite' => $data['address']['suite'],
            'address_zipcode' => $data['address']['zipcode']
        ];

        $item = User::findOrFail($id);
        $item->update($fields);

        return response()->json('Successfully updated');

    }

    public function destroy($id)
    {

        $item = User::findOrFail($id);
        // $item->delete();

        return response()->json('Successfully deleted');

    }


}