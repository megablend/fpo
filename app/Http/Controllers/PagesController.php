<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    protected $layout = 'layouts.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = "Welcome to our ICT Academia";
        return $this->setPageContent(view('index', $data));
    }

    /**
     * Return the sign up page.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->layout = 'layouts.home';
        $data['title'] = "Get Started As A Student";
        return $this->setPageContent(view('registration', $data)); 
    }

    /**
     * Check merchant's  email address.
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyEmail(Request $request)
    {
        $params = $request->input('params');
        $user = User::VerifyEmail($params['email']);
        $status = $user->count() > 0 ? true :false;
        return response()->json(['status' => $status]);
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

    /**
     * Set Controller Default Layout And Render Content
     *
     * @param string $content
     * @return \Illuminate\Http\Response
     */
    protected function setPageContent($content)
    {
       return view($this->layout, ['content' => $content]);
    }
}
