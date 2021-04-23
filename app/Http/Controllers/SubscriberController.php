<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use App\ActivityLog;
use DB;
use Carbon\Carbon;
use Mail;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('view_subscriber')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $subscribers = DB::table('subscribers')
            ->select('id', 'subscribers_email', 'created_at')
            ->latest()
            ->get();

        return view('manageSubscribers.viewsubscriber')
        ->with('subscribers', $subscribers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('create_subscriber')) {
                return $next($request);
            }
            return redirect()->back();
        });
        $subscriber = new Subscriber();

        $check = Subscriber::where('subscribers_email','=',$request->email)->count();

        if($check >= 1)
            return redirect('/')->with('message','Email Aready Exist');
        else{
            $subscriber->subscribers_email = $request->email;
            $subscriber->save();
            return redirect('/')->with('message','You will get all information about product loan through your email');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subscriber = Subscriber::findOrFail($id);

        return view('manageSubscribers.showsubscriber')
        ->with('subscriber', $subscriber);
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
    public function destroy(Request $request, $id)
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('delete_subscriber')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $uid = \Auth::id();
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->delete();
        ActivityLog::where('changetype', 'Delete Subscriber')->update(['user_id' => $uid]);

        $request->session()->flash('message', 'Subscriber is successfully deleted');
        return back();
    }

    public function subscriberReplyEmail(Request $request)
    {
        $this->validate(request(),[
            'to' => 'required',
            'title' => 'required',
            'messageinfo' => 'required',
        ]);

        $data  = array(
            'to' => $request->to,
            'title' => $request->title,
            'messageinfo' => $request->messageinfo
        );

        try {

            Mail::send('emails.show', $data, function ($message) use ($data)
            {
                $message->to($data['to']);
                $message->from('feisal29@gmail.com');
                $message->subject('Marketplace News Information Updates');

            });
            return redirect()->back()->with('message','Email Sent Successful');

        } catch (\Swift_SwiftException $exception) {
         return redirect()->back()->with('message','Can not sent mail due to your network');
        }
    }
}
