<?php

namespace App\Http\Controllers;


use App\Models\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class GateController extends Controller
{


    public function index()
    {

        $gates = Gate::latest()->paginate(10);


        return view('gates.index', compact('gates'));

    }






    public function create()
    {

        return view('gates.create');

    }






    public function store(Request $request)
    {


        $validated = $request->validate([


            'name' => 'required|string|max:255',


            'location' => 'nullable|string|max:255',


            'description' => 'nullable|string',


            'status' => 'required|boolean',


        ]);






        Gate::create([


            'name' => $validated['name'],


            'gate_code' => 'GATE-' . strtoupper(Str::random(6)),


            'location' => $validated['location'] ?? null,


            'description' => $validated['description'] ?? null,


            'status' => $validated['status'],


        ]);







        return redirect()

            ->route('gates.index')

            ->with('success','Gate created successfully');


    }









    public function show(Gate $gate)
    {

        return view('gates.show', compact('gate'));

    }









    public function edit(Gate $gate)
    {

        return view('gates.edit', compact('gate'));

    }









    public function update(Request $request, Gate $gate)
    {



        $validated = $request->validate([


            'name' => 'required|string|max:255',


            'location' => 'nullable|string|max:255',


            'description' => 'nullable|string',


            'status' => 'required|boolean',


        ]);








        $gate->update([


            'name' => $validated['name'],


            'location' => $validated['location'] ?? null,


            'description' => $validated['description'] ?? null,


            'status' => $validated['status'],


        ]);







        return redirect()

            ->route('gates.index')

            ->with('success','Gate updated successfully');


    }









    public function destroy(Gate $gate)
    {


        $gate->delete();



        return redirect()

            ->route('gates.index')

            ->with('success','Gate deleted successfully');


    }



}