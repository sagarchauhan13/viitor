<?php

namespace App\Http\Controllers;

use App\Models\RegisterUser;
use Illuminate\Http\Request;
use DB;
use Auth;

class RegisterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registerUsers = RegisterUser::latest()->paginate(5);
        // $registerUsers = RegisterUser::blogs()
        //             ->get();
        // $registerUsers = RegisterUser::with('blogs')->latest()->paginate(5);
      
        return view('users.index',compact('registerUsers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'dob' => 'required',
        ]);
      
        RegisterUser::create($request->all());
       
        return redirect()->route('registerusers.index')
                        ->with('success','User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegisterUser  $registerUser
     * @return \Illuminate\Http\Response
     */
    public function show(RegisterUser $registerUser)
    {
        return view('users.show',compact('registerUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RegisterUser  $registerUser
     * @return \Illuminate\Http\Response
     */
    public function edit(RegisterUser $registeruser)
    {
        // return view('users.edit',compact('registeruser'));
        return view('users.edit',[
            'registeruser' => $registeruser
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RegisterUser  $registerUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegisterUser $registeruser)
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'dob' => 'required',
        ]);

        $registeruser->update($request->all());
      
        return redirect()->route('registerusers.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegisterUser  $registerUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegisterUser $registeruser)
    {
        $registeruser->delete();
       
        return redirect()->route('registerusers.index')
                        ->with('success','User deleted successfully');
    }

    public function active(Request $request, RegisterUser $registeruser)
    {
        DB::table('register_users')
        ->where('id', $request->id)
        ->update(array('is_active' => 'yes'));

        return redirect()->route('registerusers.index')
                        ->with('success','User activatd successfully');
    }

    public function login()
    {
        return view('login');
    }

    public function checklogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password'  => 'required|alphaNum|min:3'
        ]);
    
        $user_data = array(
        'email'  => $request->get('email'),
        'password' => $request->get('password')
        );
    
        if(Auth::attempt($user_data))
        {
        return redirect('main/successlogin');
        }
        else
        {
        return back()->with('error', 'Wrong Login Details');
        }
    }
    
}
