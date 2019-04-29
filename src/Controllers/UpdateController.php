<?php

namespace LaravelAutoUpdate\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LaravelAutoUpdate\LaravelAutoUpdateFacade;

class UpdateController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function js()
    {
        if (config('laravelautoupdate.enabled')) {
            return response()
                    ->view("laravel-auto-update::js")
                    ->header('Content-Type', 'application/javascript');
        }
        return response()
                ->header('Content-Type', 'application/javascript');
    }

    public function check()
    {
        if (config('laravelautoupdate.enabled')) {
            if (LaravelAutoUpdateFacade::check()) {
                return [
                    'available' => true
                ];
            }
            return ['available' => false];
        }
    }

    public function download()
    {
        if (config('laravelautoupdate.enabled')) {
            LaravelAutoUpdateFacade::download();
            return ['success' => true];
        }
    }

    public function extract()
    {
        if (config('laravelautoupdate.enabled')) {
            LaravelAutoUpdateFacade::extract();
            return ['success' => true];
        }
    }

    public function move()
    {
        if (config('laravelautoupdate.enabled')) {
            LaravelAutoUpdateFacade::move();
            return ['success' => true];
        }
    }
}
