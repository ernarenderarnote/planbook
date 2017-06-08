<?php

namespace App\Http\Controllers\teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ClassLesson;
use DB;
use Session;
use Input;
use Auth;
class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	protected $data = []; 
    
	public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
	  $classLessons = new ClassLesson();
      $values = $request->all();
	  $classLessons->class_id = $request->class_id;
	  $classLessons->user_id = Auth::user()->id;
	  $classLessons->lesson_date = $request->lesson_date;
	  $classLessons->lesson_start_time = $request->starttime;
      $classLessons->lesson_end_time = $request->endtime;
	  $classLessons->unit = $request->units;
	  $classLessons->lesson_title = $request->lessonTitle;
	  $classLessons->lesson_text = $request->lessonTxt;
	  $classLessons->homework = $request->homeworkTxt;
	  $classLessons->notes = $request->notesTxt;
	  $classLessons->lock_lesson_to_date = $request->lockLesson; 
	  $lessons = ClassLesson::where('class_id',$request->class_id)->where('user_id',Auth::user()->id)->where('lesson_date',$request->lesson_date)->first();
			if ($lessons === null) {
				$classLessons->save();
				$this->data['response'] = $values;
				return view('teacher.dashboard.lesson.returndata',$this->data);
			}
			else{
				ClassLesson::where('class_id',$request->class_id)->where('lesson_date',$request->lesson_date)->where('user_id',Auth::user()->id)->update(['lesson_start_time' => $request->starttime,
				  'lesson_end_time' => $request->endtime,
				  'unit' => $request->units,
				  'lesson_title' => $request->lessonTitle,
				  'lesson_text' => $request->lessonTxt,
				  'homework' => $request->homeworkTxt,
				  'notes' => $request->notesTxt,
				  'lock_lesson_to_date' => $request->lockLesson]);
				  $this->data['response'] = $values;
				  return view('teacher.dashboard.lesson.returndata',$this->data);  
			}
	  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
