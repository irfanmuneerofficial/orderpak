<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Auth;
use Throwable;
use App\Models\Redirect301;

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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    //if old url is not found in the system, then redirect it to the new url 301_redirect
    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) 
        {
            $statusCode = $exception->getStatusCode();
            //  dd($statusCode);
            switch ($statusCode) {
                case '403':
                return response()->view('errors/403');
                        //return redirect('/');
                        // echo 'test';die;
                case '404':
                if ($request->is('product/*')) 
                {
                    //$query_part = str_replace("product/",'',$request->path());
                    $query_part = basename(request()->path()); //last(request()->segments());
                    $redirecturl = Redirect301::where('old_url',$query_part)->first();
                    if($redirecturl)
                    {
                        return redirect($request->getSchemeAndHttpHost().'/product/'.$redirecturl->new_url);
                    }
                }
                else{
                    // dd('im in execpetion '.$statusCode);
                    return redirect('/'); 
                }
                // return response()->view('errors/404');
                // return redirect('/');
                case '500';
                return response()->view('errors/500');
            }   
        }
        return parent::render($request, $exception);        
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest('/admin/login');
        }
        if ($request->is('vendor') || $request->is('vendor/*')) {
            return redirect()->guest('/vendor/login');
        }
        if ($request->is('user') || $request->is('user/*')) {
            return redirect()->guest('/login');
        }
        return redirect()->guest(route('login'));
    }
}
