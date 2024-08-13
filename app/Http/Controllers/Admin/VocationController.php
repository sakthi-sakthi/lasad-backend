<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vocation;
use App\Mail\UserVocationFormMail;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Models\Log;
use Throwable;

class VocationController extends Controller
{
    public function index()
    {
        try {
            $vocations = Vocation::all();
            return view('admin.vocation.index', compact('vocations'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'vocation',
                'message' => 'Vocation could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'Vocation could not be loaded.']);
        }
    }

    public function sendmail($id){
        $send = Vocation::where('id',$id)->first();
        
        $email = $send['email'];
         $bodyContent = [
             'toName' => $send['name'],
             ];
         {  
             try {
                Mail::to($email)->send(new UserVocationFormMail($bodyContent));
                return redirect()->back()->with(['type' => 'success', 'message' =>'Email sent Successfully.']);
                }
                 catch (\Exception $e) {
                    return redirect()->back()->with(['type' => 'error', 'message' =>'Email could not be sent.']);
             }
         } 
         
    }

    public function delete($id)
    {
        try {
            $vocation = Vocation::where('id' ,$id)->first();
            $vocation->delete();
            return redirect()->route('admin.vocation.index')->with(['type' => 'success', 'message' => 'Vocation details are deleted successfully']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'vocation',
                'message' => 'The vocation could not be deleted.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'The vocation could not be deleted.']);
        }
    }

    public function show()
    {
        try {
            $vocations = Vocation::onlyTrashed()->get();
            return view('admin.vocation.trash', compact('vocations'));
        } catch (Throwable $th) {
            Log::create([
                'model' => 'vocation',
                'message' => 'Vocation trash page could not be loaded.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'Vocation trash page could not be loaded.']);
        }
    }

    public function recover($id)
    {
        try {
            $vocation = Vocation::onlyTrashed()->findOrFail($id);
            $vocation->restore();
            return redirect()->route('admin.vocation.index')->with(['type' => 'success', 'message' => 'Vocation details are recovered successfully']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'vocation',
                'message' => 'The vocation could not be recovered.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'The vocation could not be recovered.']);
        }
    }

    public function destroy($id)
    {
        try {
            $vocation = Vocation::withTrashed()->findOrFail($id);
            $vocation->forceDelete();
            return redirect()->route('admin.vocation.trash')->with(['type' => 'warning', 'message' => 'Vocation permanently deleted.']);
        } catch (Throwable $th) {
            Log::create([
                'model' => 'vocation',
                'message' => 'The vocation could not be destroyed.',
                'th_message' => $th->getMessage(),
                'th_file' => $th->getFile(),
                'th_line' => $th->getLine(),
            ]);
            return redirect()->back()->with(['type' => 'error', 'message' => 'The vocation could not be destroyed.']);
        }
    }
}
