<?php

namespace App\Http\Controllers;

use App\Imports\MultipleSheetImport;
use App\Imports\UserImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;

class BelajarController extends Controller
{
    public function cache(Request $request)
    {

        $data = Cache::remember('users', now()->addMinutes(5), function () {
            return User::get();
        });

        return view('belajar.cache', compact('data'));
    }

    public function import(Request $request)
    {

        return view('import');
    }

    public function import_proses(Request $request)
    {
        try {
            Excel::import(new MultipleSheetImport(), $request->file('file'));
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
 
}
