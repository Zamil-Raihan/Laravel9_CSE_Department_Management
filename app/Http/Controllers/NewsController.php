<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $news = News::where('t_name', $user->name)->orderBy('created_at', 'DESC')->get();

        return view('news.ns_list', compact('news'));
    }

    public function index_public()
    {
        $news = News::orderBy('created_at', 'DESC')->get();
        return view('news.ns_list_s', compact('news'));
    }

    public function create(Request $request)
    {
        $c_id = $request->input('c_id');
        $c_code = $request->input('c_code');
        return view('news.ns_create', compact('c_id', 'c_code'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            't_name' => 'required|string|max:255',
            'c_id' => 'required|string|max:255',
            'c_code' => 'required|string|max:255',
            'news' => 'required|string',
        ]);

        if ($validator->passes()) {
            $news = new News();
            $news->t_name = $request->t_name;
            $news->c_id = $request->c_id;
            $news->c_code = $request->c_code;
            $news->news = $request->news;
            $news->save();

            return redirect()->route('news.index')->with('success', 'News created successfully.');
        } else {
            return redirect()->route('news.create')->withErrors($validator)->withInput();
        }
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('news.ns_edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            't_name' => 'required|string|max:255',
            'c_id' => 'required|string|max:255',
            'c_code' => 'required|string|max:255',
            'news' => 'required|string',
        ]);

        if ($validator->passes()) {
            $news = News::findOrFail($id);
            $news->t_name = $request->t_name;
            $news->c_id = $request->c_id;
            $news->c_code = $request->c_code;
            $news->news = $request->news;
            $news->save();

            return redirect()->route('news.index')->with('success', 'News updated successfully.');
        } else {
            return redirect()->route('news.edit', $id)->withErrors($validator)->withInput();
        }
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
    }
}
