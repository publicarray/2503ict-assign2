<?php

class EmployerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        if (Auth::check())
        {
            if(Auth::user()->role == 'employer'){
                $employers = User::has('employer')->get();
                return View::make('employer.index', compact('employers'));
            }else{
                return View::make('employer.index');
            }
        }else{
            return View::make('employer.index');
        }
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('employer.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
        // $v = Validator::make($input, Employer::$rules);

        // if ($v->passes())
        // {
            $password = $input['password'];
            $role = 'employer';

            $user = new User;
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->phone = $input['phone'];
            $user->username = $input['username'];
            $user->password = Hash::make($password);
            $user->role = $role;
            $user->remember_token = "default";
            $user->image = $input['image'];
            $user->save();

            $employer = new Employer;
            $employer->industry = $input['industry'];
            $employer->city = $input['city'];
            $employer->description = $input['description'];
            $employer->user_id = $user->id;
            $employer->save();
            return Redirect::route('employer.show', $user->id);
        // }else{
            // Show validation errors
            // return Redirect::route('employer.create')->withErrors($v)->withInput();
        // }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $user = User::with('employer')->find($id);
        $employer = Employer::whereHas('user', function($q) use ($id)
            {
                $q->where('id', '=', $id);
            })->first();

        return View::make('employer.show', compact('employer', 'user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $user = User::with('employer')->find($id);
// 		$user = User::whereHas('employer', function($q) use ($id)
//             {
//                 $q->where('user_id', '=', $id);
//             })->first();

        $employer = Employer::whereHas('user', function($q) use ($id)
            {
                $q->where('id', '=', $id);
            })->first();
// $user = array_merge($user, $employer);
        
        $user = $user->merge($employer);
        return View::make('employer.edit', compact('user', 'employer'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
        $user = User::find($id);
        $employer = User::whereHas('employer', function($q) use ($id)
            {
                $q->where('user_id', '=', $id);
            })->first();

        $password = $input['password'];

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->phone = $input['phone'];
        $user->username = $input['username'];
        if($password != null){
            $user->password = Hash::make($password);
        }
        $user->remember_token = "default";
        $user->image = $input['image'];
        $user->save();

        $employer->industry = $input['industry'];
        $employer->city = $input['city'];
        $employer->description = $input['description'];
        $employer->save();


        return Redirect::route('employer.show', $user->id);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}