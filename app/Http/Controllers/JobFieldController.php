<?php

namespace App\Http\Controllers;

use App\Models\JobField;
use App\Http\Requests\StoreJobFieldRequest;
use App\Http\Requests\UpdateJobFieldRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JobFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = JobField::paginate(10);
        return view('jobfield.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobfield.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobFieldRequest $request): RedirectResponse
    {
        $validated = $request->validate([
            'description' => ['required', 'string', 'max:255'],
        ]);
        if ($validated) {
            JobField::create([
                'description' => $request->description,
                'created_by' => Auth::id(),
            ]);
            return redirect()->route('jobfield.index')->with('success', 'Record Created Successfully');
        } else {
            return redirect()->route('jobfield.create')->with('error', 'Fail to Create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $jobField = JobField::find($request->id);
        return view('jobfield.edit', $jobField);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobField $jobfield)
    {
        return view('jobfield.edit', ['jobfield' => $jobfield]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobFieldRequest $request, JobField $jobfield): RedirectResponse
    {
        $validated = $request->validate([
            'description' => ['required', 'string', 'max:255'],
        ]);
        if ($validated) {
            $jobfield->update([
                'description' => $request->description,
                'created_by' => Auth::id(),
            ]);

            return redirect()->route('jobfield.index')->with('success', 'Record Updated Successfully');
        } else {
            return redirect()->route('jobfield.edit', $jobfield)->with('error', 'Record Fail to Update');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        JobField::find($request->jobfield)->update(
            [
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]
        );
        JobField::find($request->jobfield)->delete();
        return redirect()->route('jobfield.index')->with('success', 'Record Deleted');
    }
}
