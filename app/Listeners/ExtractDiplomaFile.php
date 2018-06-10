<?php

namespace App\Listeners;

use App\Events\DiplomaUploaded;
use App\Repository\RegistrationRepository;
use Chumper\Zipper\Zipper;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Class ExtractDiplomaFile
 *
 * @package App\Listeners
 */
class ExtractDiplomaFile implements ShouldQueue

{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param DiplomaUploaded $diploma
     * @return void
     * @internal param object $event
     */
    public function handle(DiplomaUploaded $diploma)
    {

        // extract the file here and update registration file

        $zip = new Zipper;
        $zip->make(storage_path('app/'.$diploma->filePath))
            ->extractTo(storage_path('app/'.$diploma->path));


        $files = Storage::allFiles($diploma->path.'/zip');

        $registrationRepo = new RegistrationRepository();

        foreach ($files as $file){

            $socialId = pathinfo(basename(basename($file)), PATHINFO_FILENAME);;
            $fullPath = storage_path('app/'.$file);
            $registrationRepo->updateDiplomaFile($diploma->courseId, $socialId, $fullPath);
            Log::info('File data', ['socialId' => $socialId, 'full path: '=> $fullPath]);

        }



    }
}
