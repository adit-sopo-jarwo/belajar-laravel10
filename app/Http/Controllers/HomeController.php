<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Rumah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['role:admin|writer']);
        // $this->middleware(['permission:view_dashboard']);
        $this->middleware(['permission:view_dashboard']);
    }

    public function dashboard(Request $request)
    {
        // resitrict the view
        // if(auth()->user()->can('view_dashboard')){
        $rumah = Rumah::get();
        $mobil = Mobil::get();
        return view('dashboard', compact('rumah', 'mobil'));
        // }
        // return abort(403);
    }

    public function index(Request $request)
    {
        $data = new User;

        if ($request->get('search')) {
            $data = $data->where('name', 'LIKE', '%' . $request->get('search') . '%')->orWhere('email', 'LIKE', '%' . $request->get('search') . '%');
        }

        $data = $data->get();


        // this is f u want to show the file has deleted on the list
        // $data = $data->withTrashed();

        return view('index', compact('data', 'request'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'photo' => 'required|mimes:png,jpg,jpeg[max:2048]',
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $photo = $request->file('photo');
        $filename = date('Y-m-d') . $photo->getClientOriginalName();
        $path = 'photo-user/' . $filename;

        Storage::disk('public')->put($path, file_get_contents($photo));

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['image'] = $filename;


        User::create($data);
        return redirect()->route('admin.index');

    }

    public function edit(Request $request, $id)
    {
        $data = User::findOrFail($id);
        return view('edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable',
            'photo' => 'required|mimes:png,jpg,jpeg[max:2048]',
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $find = User::find($id);

        $data['name'] = $request->name;
        $data['email'] = $request->email;

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $photo = $request->file('photo');

        if ($photo) {

            $filename = date('Y-m-d') . $photo->getClientOriginalName();
            $path = 'photo-user/' . $filename;

            if ($find->image) {
                Storage::disk('public')->delete('photo-user/' . $find->image);
            }
            Storage::disk('public')->put($path, file_get_contents($photo));


            $data['image'] = $filename;
        }


        $find->update($data);
        return redirect()->route('admin.index');
    }

    public function delete(Request $request, $id)
    {
        $data = User::findOrFail($id);
        if ($data) {
            //if u want to deleted permanent u can use force delete 
            $data->delete();
        }

        return redirect()->route('admin.index');
    }
}
