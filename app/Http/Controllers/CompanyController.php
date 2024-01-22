<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Company::paginate(10);
        return view('company.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        $validated = $request->validate([
            'ssm_no' => 'required',
            'name' => ['required', 'unique:' . Company::class],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validated) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);

            Company::create([
                'name' => $request->name,
                'ssm_no' => $request->ssm_no,
                'industry' => $request->industry,
                'size' => $request->size,
                'location' => $request->location,
                'website' => $request->website,
                'picture' => URL::asset('/images/' . $imageName),
                'created_by' => Auth::id(),
                'created_at' => now(),
            ]);

            return redirect()->route('company.index')->with('success', 'Record Created');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('company.edit', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $company = Company::find($request->id);

        return view('company.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company): RedirectResponse
    {
        $validated = $request->validate([
            'ssm_no' => 'required',
            'name' => 'required',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validated) {
            if ($request->picture != null && $request->picture != '') {
                $imageName = time() . '.' . $request->picture->extension();
                $request->picture->move(public_path('images'), $imageName);
                $url = URL::asset('/images/' . $imageName);
            } else {
                $url = $company->picture;
            }

            $company->update([
                'name' => $request->name,
                'ssm_no' => $request->ssm_no,
                'industry' => $request->industry,
                'size' => $request->size,
                'location' => $request->location,
                'website' => $request->website,
                'picture' => $url,
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]);
            return redirect()->route('company.show',['company' => $company])->with('success', 'Record Updated');
        } else {
            return redirect()->route('company.edit', ['company' => $company])->with('error', 'Record Fail to Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Company::find($request->company)->update(
            [
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]
        );
        Company::find($request->company)->delete();
        return redirect()->route('company.index')->with('success', 'Record Deleted');
        //
    }
}
