<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\Category;
use App\Models\Log;
use Throwable;

class InstitutionController extends Controller
{
   public function index()
   {
        $institutions = Institution::orderBy('id','asc')->get();
        return view('admin.institution.index',compact('institutions'));
   }
   
   public function create()
    {
        try {
            $institutions = Institution::all();
            $categories = Category::where('parent', 'institution')->get();
            return view('admin.institution.create', compact('categories', 'institutions'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'Institution',
                'message' => 'Institution create page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'Institution create page could not be loaded.']);
        }
    }

   public function store(Request $request)
   {
        try {
            $request->validate([
                'title' => 'required',
                'place' => 'nullable',
                'content' => 'nullable',
                'year' => 'nullable',
                'category_id' => 'nullable',
                'media_id' => 'nullable',
            ]);

            Institution::create([
                'media_id' => $request->media_id ?? 1,
                'category_id' => $request->category_id ?? 1,
                'title' => $request->title,
                'place' => $request->place,
                'content' => $request->content,
                'year' => $request->year,
                'status' => 1,
            ]);

            return redirect()->route('admin.institution.index')->with(['type' => 'success', 'message' => 'Institution details are Saved.']);
        } catch (Throwable $th) {
            dd($th);
            return redirect()->back()->with(['type' => 'error', 'message' => 'The institution could not be saved.']);
        }
   }

   public function edit($id)
   {
        try {
            $institutions = Institution::find($id);
            $categories = Category::where('parent', 'institution')->get();
            return view('admin.institution.edit', compact('institutions', 'categories'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'Institution',
                'message' => 'Institution edit page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'Institution edit page could not be loaded.']);
        }
   }

   public function update(Request $request, $id)
   {
        try {
            $request->validate([
                'title' => 'required',
                'place' => 'nullable',
                'content' => 'nullable',
                'year' => 'nullable',
                'category_id' => 'required',
                'media_id' => 'nullable',
            ]);
            $institution = Institution::find($id);
            $institution->title = $request->title;
            $institution->place = $request->place;
            $institution->content = $request->content;
            $institution->year = $request->year;
            $institution->category_id = $request->category_id;
            $institution->media_id = $request->media_id ?? 1;
            $institution->save();

            return redirect()->route('admin.institution.index')->with(['type' => 'success', 'message' => 'Institution details are Updated.']);
        } catch (Throwable $th) {
            dd($th);
            return redirect()->back()->with(['type' => 'error', 'message' => 'The institution could not be updated.']);
        }
   }

   public function show($id)
    {
        return redirect()->route('admin.institution.index');
    }

   public function trashed()
   {
        $institutions = Institution::onlyTrashed()->get();
        return view('admin.institution.trash', compact('institutions'));

    }

    public function recover($id)
    {
        $institution = Institution::withTrashed()->find($id);
        $institution->restore();
        return redirect()->route('admin.institution.index')->with('success', 'Institution restored successfully.');
    }

    public function destroy($id)
    {
        $institution = Institution::withTrashed()->find($id);
        $institution->forceDelete();
        return redirect()->route('admin.institution.index')->with('success', 'Institution deleted successfully.');
    }

    public function delete($id)
    {
        $institution = Institution::find($id);
        $institution->delete();
        return redirect()->route('admin.institution.index')->with('success', 'Institution deleted successfully.');
    }
    public function updateorder(Request $request)
    {
        
        try {
            $order = $request->id;
         Institution::find($order)->update([
                'status' => $request->status 
            ]);
            return $request->status;
        } catch (Throwable $th) {
            return response()->json(['type' => 'error', 'message' => 'Status update failed.'], 500);
        }
    }
}
