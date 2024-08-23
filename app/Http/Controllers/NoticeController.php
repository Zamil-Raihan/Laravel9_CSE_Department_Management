<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::orderBy('created_at', 'DESC')->get();
        return view('notice.n_list', compact('notices'));
    }

    public function index_public()
    {
        $notices = Notice::orderBy('created_at', 'DESC')->get();
        return view('notice.n_list_s', compact('notices'));
    }
    public function create()
    {
        return view('notice.n_create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notice' => 'required|string',
            'attachment' => 'nullable|mimes:pdf,docx,ppt,pptx',
        ]);

        if ($validator->passes()) {
            $notice = new Notice();
            $notice->notice = $request->notice;

            if ($request->hasFile('attachment')) {
                $attachment = $request->file('attachment');
                $filename = time() . '.' . $attachment->getClientOriginalExtension();
                $attachment->move(public_path('uploads/notices'), $filename);
                $notice->attachment = $filename;
            }

            $notice->save();

            return redirect()->route('notice.index')->with('success', 'Notice created successfully.');
        } else {
            return redirect()->route('notice.create')->withErrors($validator)->withInput();
        }
    }

    public function edit($id)
    {
        $notice = Notice::findOrFail($id);
        return view('notice.n_edit', compact('notice'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'notice' => 'required|string',
            'attachment' => 'nullable|mimes:pdf,docx,ppt,pptx',
        ]);

        if ($validator->passes()) {
            $notice = Notice::findOrFail($id);
            $notice->notice = $request->notice;

            if ($request->hasFile('attachment')) {
                $attachment = $request->file('attachment');
                $filename = time() . '.' . $attachment->getClientOriginalExtension();
                $attachment->move(public_path('uploads/notices'), $filename);
                $notice->attachment = $filename;
            }

            $notice->save();

            return redirect()->route('notice.index')->with('success', 'Notice updated successfully.');
        } else {
            return redirect()->route('notice.edit', $id)->withErrors($validator)->withInput();
        }
    }

    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);
        if ($notice->attachment) {
            File::delete(public_path('uploads/notices/' . $notice->attachment));
        }
        $notice->delete();

        return redirect()->route('notice.index')->with('success', 'Notice deleted successfully.');
    }
}
