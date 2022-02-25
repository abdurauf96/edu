<?php

namespace App\Http\Controllers\School;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Staff;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use Illuminate\Http\Request;

class StaffsController extends Controller
{
    public $staffRepo;

    public function __construct(StaffRepositoryInterface $staffRepo)
    {
        $this->staffRepo=$staffRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $staffs = $this->staffRepo->getAll();

        return view('school.staffs.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('school.staffs.create');
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
        $this->validate($request, [
			'name' => 'required',
			'year' => 'required',
		]);
        $this->staffRepo->store($request);

        return redirect('school/staffs')->with('flash_message', 'Xodim qo`shildi!');
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
        $staff = $this->staffRepo->findOne($id);

        return view('school.staffs.show', compact('staff'));
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
        $staff = $this->staffRepo->findOne($id);

        return view('school.staffs.edit', compact('staff'));
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
        $this->validate($request, [
			'name' => 'required'
		]);
        $this->staffRepo->update($request, $id);

        return redirect('school/staffs')->with('flash_message', 'Xodim yangilandi!');
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
        Staff::destroy($id);

        return redirect('school/staffs')->with('flash_message', 'Xodim o`chirib yuborildi!');
    }

    public function staffEvent($id)
    {
        $staff = $this->staffRepo->findOne($id);

        return view('school.staffs.event', compact('staff'));
    }

    public function generateCard($id)
    {
        $staff=$this->staffRepo->findOne($id);
        $this->staffRepo->generateIdCard($staff);
           
        return back()->with('flash_message', 'Ushbu xodim uchun ID card yaratildi!  ');
    }
}
