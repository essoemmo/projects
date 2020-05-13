<?php

namespace App\Exceptions;

use App\Help\Utility;
use Auth;
use Illuminate\Auth\AuthenticationException;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
//    public function render($request, Exception $exception)
//    {
//        return parent::render($request, $exception);
//    }

    public function render($request, Exception $e){
        if ($this->isHttpException($e)) {
         
            switch ($e->getStatusCode()) {
                
                // not authorized
                case '401':
                   {
                        if(request()->ajax())
                           return  response()->json(['msg' => $e->getMessage(), 'status' => 'error']);
                         //  dd($e->getStatusCode());
                        
                        else
                        {
                          //  dd(0);
                           return back()->with('error' ,_i('Not Avalibale log out first'));
                        }
                       // return \Response::view('not_found',array(),403);
                    }
                    break;
                case '403':
                    if (($request->is('master') || $request->is('master/*'))&& !auth()->guard()) {
                        return redirect()->guest('/master/login');
                    }elseif (($request->is('adminpanel') || $request->is('adminpanel/*'))&& !auth()->guard()){
                        return redirect()->guest('/webLogin');
                    }else{
                        if(request()->ajax())
                           return  response()->json(['msg' => $e->getMessage(), 'status' => 'error']);
                         //  dd($e->getStatusCode());
                           return back()->with('error' ,_i('Feature is not available at this package !'));
                       // return \Response::view('not_found',array(),403);
                    }
                    break;

                // not found
                case '404':
                    if (($request->is('master') || $request->is('master/*'))&& !auth()->guard()) {
                        return redirect()->guest('/master/login');
                    }elseif (($request->is('adminpanel') || $request->is('adminpanel/*'))&& !auth()->guard()){
                        return redirect()->guest('/webLogin');
                    }else{
                        return \Response::view('not_found',array(),404);
                    }
                    break;

                // internal error
                case '500':
                    if (($request->is('master') || $request->is('master/*'))&& !auth()->guard()) {
                        return redirect()->guest('/master/login');
                    }elseif (($request->is('adminpanel') || $request->is('adminpanel/*'))&& !auth()->guard()){
                        return redirect()->guest('/webLogin');
                    }else{
                        return \Response::view('not_found',array(),500);
                    }
                    break;

                default:
                    return $this->renderHttpException($e);
                    break;
            }
        } else {
            return parent::render($request, $e);
        }
    }


    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        
        
        // redirect to (/adminpanel/login) if request url contain (adminpanel) and not authenticated
        if ($request->is('adminpanel') || $request->is('adminpanel/*')) {
           // return redirect()->guest('/adminpanel/login');
            return redirect()->guest('/webLogin');
        }
        // redirect to (/master/login) if request url contain (master) and not authenticated
        if ($request->is('master') || $request->is('master/*')) {
            return redirect()->guest('/master/login');
            // return route('MasterLogin');
        }
        return redirect()->guest(route('login'));
    }



}
