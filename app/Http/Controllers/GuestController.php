<?php

namespace App\Http\Controllers;

use App\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $num_page = 5;
        $guests = Guest::orderBy('id','asc')->paginate($num_page);
        $start=($request->page-1)*$num_page;
        if($start<0)$start=0;
        return view('guests.index',compact('guests', $guests))->with('start',$start);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guests.create');
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:guests',
            'content' => 'required'
        ]);
        
        $guest = Guest::create(['name' => $request->name,'email' => $request->email,'content' => $request->content]);
        $request->session()->flash('message', 'Successfully add the new Guest!');
        return redirect('guests');
    }
 
    /**
     * Display the specified resource.
     *
     * @param  \App\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function show(Guest $guest)
    {
        return view('guests.show',compact('guest',$guest));
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function edit(Guest $guest)
    {
        return view('guests.edit',compact('guest',$guest));
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guest $guest)
    {
        try{
            //Validate
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'content' => 'required'
            ]);
            
            $guest->name = $request->name;
            $guest->email = $request->email;
            $guest->content = $request->content;
            $guest->save();
            $msg = "Successfully modified the Guest!";
        }catch(\Exception $e){
            $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                $msg = "SQL Error (".$error_code.") : Duplicate value E-mail address!";
            }else{
                $msg = "SQL Error (".$error_code.")";
            }
        }
        $request->session()->flash('message', $msg);
        return redirect('guests');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Guest $guest)
    {
        $guest->delete();
        $request->session()->flash('message', 'Successfully deleted the Guest!');
        return redirect('guests');
    }
}
