<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $documents = Document::latest()->get();

        return view('admin.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.documents.create');
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
			'title' => 'required',
		]);
        $requestData = $request->all();
        if($request->hasFile('file')){
            $file=$request->file('file');
            $filename=time().'-'.$file->getClientOriginalName();
            $file->move('documents', $filename);
            $requestData['file']=$filename;
        }
        Document::create($requestData);

        return redirect('admin/documents')->with('flash_message', 'Document qo`shildi!');
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
        $document = Document::findOrFail($id);

        return view('admin.documents.show', compact('document'));
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
        $document = Document::findOrFail($id);

        return view('admin.documents.edit', compact('document'));
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
        if($request->hasFile('file')){
            $file=$request->file('file');
            $filename=time().'-'.$file->getClientOriginalName();
            $file->move('documents', $filename);
            $requestData['file']=$filename;
        }
        $document = Document::findOrFail($id);

        $document->update($requestData);

        return redirect('admin/documents')->with('flash_message', 'Document yangilandi!');
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
        Document::destroy($id);

        return redirect('admin/documents')->with('flash_message', 'Document o`chirib yuborildi!');
    }
}
