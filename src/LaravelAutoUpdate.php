<?php

namespace LaravelAutoUpdate;

use Exception;
use ZipArchive;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class LaravelAutoUpdate
{
    /**
     * Get information from host.
     *
     * @return array
     */
    public function info()
    {
        static $out = null;
        if ($out == null) {
            if (empty(config('laravelautoupdate.info_file'))) {
                throw new Exception("Please fill config info_file first.");
            }
            if (empty(env('APP_VERSION'))) {
                throw new Exception("Please fill APP_VERSION in .env first.");
            }
            $out = json_decode(file_get_contents(config('laravelautoupdate.info_file')), true);
            if (json_last_error() != null) {
                throw new Exception("JSON Decode Error: ".json_last_error_msg());
            }
            if (@$out['version'] == null) {
                throw new Exception("Info file 'version' key is empty.");
            }
            if (@$out['file'] == null) {
                throw new Exception("Info file 'file' key is empty.");
            }
        }
        return $out;
    }

    /**
     * Check update exists
     *
     * @return null|string
     */
    public function check()
    {
        $info = $this->info();
        $currentVersion = explode('.', env('APP_VERSION'));
        foreach (explode(".", $info['version']) as $key => $value) {
            if (intval($value) > intval($currentVersion[$key])) {
                return $info['version'];
            }
        }
    }

    /**
     * Run given commands
     *
     * @param array $commands
     * @return void
     */
    public function runCommands($commands)
    {
        $matches = null;
        foreach ($commands as $command) {
            if (preg_match("/^artisan (.*)$/", $command, $matches)) {
                Artisan::call($matches[1]);
            } else {
                shell_exec($command);
            }
        }
    }

    /**
     * Download archive
     *
     * @return void
     */
    public function download()
    {
        $this->runCommands(config('laravelautoupdate.before_update_commands'));
        $url = $this->info()['file'];
        if (strpos($url, "http") == false) {
            $url = rtrim(dirname(config('laravelautoupdate.info_file')), "/").'/'.ltrim($url, "/");
        }
        $content = file_get_contents($url);
        if (! File::isDirectory(config('laravelautoupdate.temp_path'))) {
            File::makeDirectory(config('laravelautoupdate.temp_path'), 0755, true);
        }
        @File::put(rtrim(config('laravelautoupdate.temp_path'), "/")."/update.zip", $content);
    }

    /**
     * Extract downloaded zip.
     *
     * @return void
     */
    public function extract()
    {
        if (File::exists(rtrim(config('laravelautoupdate.temp_path'), "/")."/update.zip")) {
            $zip = new ZipArchive;
            if ($zip->open(rtrim(config('laravelautoupdate.temp_path'), "/")."/update.zip") === true) {
                $zip->extractTo(config('laravelautoupdate.temp_path'));
                $zip->close();
                File::delete(rtrim(config('laravelautoupdate.temp_path'), "/")."/update.zip");
            } else {
                throw new Exception("Failed to open update zip file.");
            }
        }
    }

    /**
     * Move extracted file to root.
     *
     * @return void
     */
    public function move()
    {
        if (File::isDirectory(config('laravelautoupdate.temp_path'))) {
            foreach (File::directories(rtrim(config('laravelautoupdate.temp_path'), "/").'/') as $directory) {
                if (basename($directory) == 'public') {
                    File::copyDirectory($directory, public_path('/'));
                } else {
                    File::copyDirectory($directory, base_path(basename($directory)));
                }
                File::deleteDirectory($directory);
            }
            foreach (File::files(rtrim(config('laravelautoupdate.temp_path'), "/").'/') as $file) {
                File::copy($file, base_path(basename($file)));
            }
            File::deleteDirectory(config('laravelautoupdate.temp_path'));

            $envContent = file_get_contents(app()->environmentFilePath());
            $envContent = preg_replace("/APP_VERSION=[^\r\n]+/", 'APP_VERSION='.$this->info()['version'], $envContent);
            file_put_contents(app()->environmentFilePath(), $envContent);
            $afterUpdateCommands = config('laravelautoupdate.after_update_commands');
            if (file_exists(config_path("laravelautoupdate.php"))) {
                $afterUpdateCommands = require config_path("laravelautoupdate.php");
                $afterUpdateCommands = $afterUpdateCommands['after_update_commands'];
            }
            $this->runCommands($afterUpdateCommands);
        }
    }
}
