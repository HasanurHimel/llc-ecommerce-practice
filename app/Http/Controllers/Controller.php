<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use test\Mockery\MockingProtectedMethodsTest;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function setSuccess($message){

        session()->flash('type', 'success');
        session()->flash('message', $message);
    }
    protected function setWarning($message){

        session()->flash('type', 'warning');
        session()->flash('message', $message);
    }
}

