<?php

namespace App\Http\Controllers\School;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Login;
use Illuminate\Http\Request;

class LoginsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $logins = Login::latest()->with('user')->get();

        return view('school.logins.index', compact('logins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('school.logins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        Login::create($requestData);

        return redirect('school/logins')->with('flash_message', 'Login qo`shildi!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $login = Login::findOrFail($id);

        return view('school.logins.show', compact('login'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $login = Login::findOrFail($id);

        return view('school.logins.edit', compact('login'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $login = Login::findOrFail($id);
        $login->update($requestData);

        return redirect('school/logins')->with('flash_message', 'Login yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Login::destroy($id);

        return redirect('school/logins')->with('flash_message', 'Login o`chirib yuborildi!');
    }
}
