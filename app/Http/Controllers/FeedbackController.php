<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'DESC')->get();
        return view('feedback.f_list', compact('feedbacks'));
    }

    public function create(Request $request)
    {
        $t_id = $request->input('t_id');
        $t_name = $request->input('t_name');
        $c_id = $request->input('c_id');
        $c_code = $request->input('c_code');
        return view('feedback.f_create', compact('t_id', 't_name', 'c_id', 'c_code'));
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            's_id' => 'required|string',
            't_id' => 'required|string',
            't_name' => 'required|string',
            'c_id' => 'required|string',
            'c_code' => 'required|string',
            'feedback' => 'required|string',
        ]);

        if ($validator->passes()) {
            $feedback = new Feedback();
            $feedback->s_id = $request->s_id;
            $feedback->t_id = $request->t_id;
            $feedback->t_name = $request->t_name;
            $feedback->c_id = $request->c_id;
            $feedback->c_code = $request->c_code;
            $feedback->feedback = $request->feedback;
            $feedback->save();

            return redirect()->route('course.index_public')->with('success', 'Feedback submitted successfully.');
        } else {
            return redirect()->route('feedback.create')->withErrors($validator)->withInput();
        }
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('feedback.index')->with('success', 'Feedback deleted successfully.');
    }
}
