<?php

namespace App\Http\Controllers\School;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Staff;
use App\Models\Organization;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StaffsController extends Controller
{
    public function __construct(public StaffRepositoryInterface $staffRepo) {}

    public function index(Request $request): View
    {
        //$staffs = $this->staffRepo->getAll();
        $organizations = Organization::school()->latest()->get();

        return view('school.staffs.index', compact('organizations'));
    }

    public function create(): View
    {
        $organizations = Organization::school()->latest()->get();
        return view('school.staffs.create', compact('organizations'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
			'name' => 'required',
			'year' => 'required',
		]);
        $this->staffRepo->store($request);

        return redirect('school/staffs')->with('flash_message', 'Xodim qo`shildi!');
    }

    public function show($id): View
    {
        $staff = $this->staffRepo->findOne($id);

        return view('school.staffs.show', compact('staff'));
    }

    public function edit($id): View
    {
        $staff = $this->staffRepo->findOne($id);
        $organizations = Organization::school()->latest()->get();
        return view('school.staffs.edit', compact('staff', 'organizations'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
			'name' => 'required'
		]);
        $this->staffRepo->update($request, $id);

        return redirect('school/staffs')->with('flash_message', 'Xodim yangilandi!');
    }

    public function destroy($id): RedirectResponse
    {
        Staff::destroy($id);

        return redirect('school/staffs')->with('flash_message', 'Xodim o`chirib yuborildi!');
    }

    public function staffEvent($id): View
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

    public function downloadCard($idcard){
        if(file_exists('admin/images/idcards/'.$idcard)){
            return response()->download(public_path('admin/images/idcards/'.$idcard));
        }
    }

    public function downloadStaffQrcode($id){
        $staff=$this->staffRepo->findOne($id);
        if(!file_exists('admin/images/qrcodes/'.$staff->qrcode)){
            generateQrcode($staff->id, $staff->qrcode, 'staff');
        }
        return response()->download('admin/images/qrcodes/'.$staff->qrcode);
    }
}
