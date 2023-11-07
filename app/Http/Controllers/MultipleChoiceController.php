<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MultipleChoice;
use Illuminate\Support\Facades\DB;

class MultipleChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = MultipleChoice::all();
        return view('backend.pages.quize.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.quize.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $item = new MultipleChoice();
            $item->name = $request->name;
            $item->content = $request->form;
            $item->save();
            DB::commit();
            $output = [
                'status' => 'success',
                'message' => 'Data has been saved succesfully.',
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            $output = [
                'status' => 'success',
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($output);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MultipleChoice  $multipleChoice
     * @return \Illuminate\Http\Response
     */
    public function show(MultipleChoice $multipleChoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MultipleChoice  $multipleChoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return MultipleChoice::where('id', $request->id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MultipleChoice  $multipleChoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $item = MultipleChoice::findOrFail($request->id);
            $item->name = $request->name;
            $item->content = $request->form;
            $item->update();
            DB::commit();
            $output = [
                'status' => 'success',
                'message' => 'Data has been updated succesfully.',
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            $output = [
                'status' => 'success',
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MultipleChoice  $multipleChoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $form = MultipleChoice::findOrFail($id);
        $form->delete();

        return redirect('admin/multiple_choice/index')->with('success', ' Deleted successfully');
    }
}