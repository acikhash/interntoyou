<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\JobField;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 2) {
            $list =  DB::table('posts')
                ->where('Company_id', '=', Auth::user()->company_id)
                ->paginate(10);
            return view('post.list', compact('list'));
        } else {
            $list = Post::paginate(10);
            return view('post.index', compact('list'));
        }
    }

    /**
     * Display a listing of post for specific company.
     */
    public function list()
    {
        $list =  DB::table('posts')
            ->where('Company_id', '=', Auth::user()->company_id)
            ->paginate(10);
        return view('post.list', compact('list'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $jobfields = JobField::all();
        return view('post.create', ['companies' => $companies, 'jobfields' => $jobfields]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {

        $validated = $request->validate([
            'company' => 'required',
            'jobfield' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validated) {

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            Post::create([
                'job_title' => $request->job_title,
                'company_id' => $request->company,
                'description' => $request->description,
                'location' => $request->location,
                'office' => URL::asset('/images/' . $imageName),
                'job_field_id' => $request->jobfield,
                'status' => $request->status,
                'created_by' => Auth::id(),
                'created_at' => now(),
            ]);
            if (Auth::user()->role == 2) {
                $list =  DB::table('posts')
                    ->where('Company_id', '=', Auth::user()->company_id)
                    ->paginate(10);
                return redirect()->route('post.list', compact('list'))->with('success', 'Record Created Successfully');;
            } else {
                $list = Post::paginate(10);
                return redirect()->route('post.index', compact('list'))->with('success', 'Record Created Successfully');;
            }
        } else {
            return redirect()->route('post.create')->with('error', 'Record Fail to Create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        $companies = Company::all();
        $jobfields = JobField::all();

        return view('post.show', ['post' => $post, 'companies' => $companies, 'jobfields' => $jobfields]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $post = Post::find($request->post);
        $companies = Company::all();
        $jobfields = JobField::all();
        $contents = Storage::get($post->office);
        return view('post.edit', ['post' => $post, 'companies' => $companies, 'jobfields' => $jobfields, 'contents' => $contents]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'company' => 'required',
            'jobfield' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        if ($validated) {

            $post->update([
                'job_title' => $request->job_title,
                'company_id' => $request->company,
                'description' => $request->description,
                'location' => $request->location,
                'office' => URL::asset('/images/' . $imageName),
                'job_field_id' => $request->jobfield,
                'status' => $request->status,
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]);
            if (Auth::user()->role == 2) {
                $list =  DB::table('posts')
                    ->where('Company_id', '=', Auth::user()->company_id)
                    ->paginate(10);
                return redirect()->route('post.list', compact('list'))->with('success', 'Record Updatedc Successfully');;
            } else {
                $list = Post::paginate(10);
                return redirect()->route('post.index', compact('list'))->with('success', 'Record Updated Successfully');;
            }
        } else {
            return redirect()->route('post.edit', $post)->with('error', 'Record Fail to Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $post = Post::find($request->post);
        $post->update(
            [
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]
        );
        $post->delete();
        return redirect()->route('post.index')->with('success', 'Record Deleted');
    }
}
