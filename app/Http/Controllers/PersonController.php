<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Person;
use Response;

class PersonController extends Controller
{
    public function all()
    {
        $person = Person::orderBy('id', 'desc')->paginate(4);
        return \response()->json($person);
    }

    // mengambil data by id
    public function show($id)
    {
        return Person::find($id);
    }

    // menambah data
    public function store(Request $request)
    {
        try{
            Person::create($request->all());
            $response = array(
                'status'=> '100',
                'message'=> 'Succes  Add Employee'
            );
            return Response::json($response);
        }catch(Exception $e){
            $response = array(
                'status'=> 404,
                'message' => $e->getMessage()
            );
            return Response::json($response);
        }
    }

    // mengubah data
    public function update($id, Request $request)
    {
        $person = Person::find($id);
        $person->update($request->all());
        $response = array(
            'status'=> '100',
            'message'=> 'Succes  Update Person'
        );
        return Response::json($response);
    }

    // menghapus data
    public function delete($id)
    {
        $person = Person::find($id);
        $person->delete();
        $response = array(
            'status'=> '100',
            'message'=> 'Succes  delete Person'
        );
        return Response::json($response);

    }
}
