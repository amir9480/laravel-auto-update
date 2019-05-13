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
        $backgroundImage = $this->imageData(realpath(__DIR__.'/../../images/background.png'));
        $loadingImage = $this->imageData(realpath(__DIR__.'/../../images/loading.gif'));
        if (config('laravelautoupdate.enabled')) {
            return response()
                    ->view("laravel-auto-update::js", compact("backgroundImage", "loadingImage"))
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

    private function imageData($path)
    {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}
