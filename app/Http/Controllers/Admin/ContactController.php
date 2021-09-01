<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Message;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $Messages = Message::Status($request)->Phone($request)->orderby('id','DESC')->paginate();
        $Messages->appends(['phone' => $request->phone]);
        $Messages->appends(['status' => $request->status]);
        return view('admin.pages.contact.contact_table')->with(compact('Messages'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Messages = Message::find($id);
        return view('admin.pages.contact.contact_form')->with(compact('Messages'));
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
        $message = Message::find($id);
        $message->status = $request->status;
        if($message->save()){
            return 1;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Message::find($id)->delete()){
            return 1;
        }
        else{
            return 0;
        }
    }
}
