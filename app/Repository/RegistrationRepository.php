<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 10/06/2018
     * Time: 8:08 PM
     */

    namespace App\Repository;


    use App\Registration;
    use Illuminate\Support\Facades\Log;

    /**
     * Class RegistrationRepository
     *
     * @package App\Repository
     */
    class RegistrationRepository
    {

        /**
         * @param $courseId
         * @param $studentSocialSecurityId
         * @param $path
         * @return null
         */
        public function updateDiplomaFile($courseId, $studentSocialSecurityId, $path){

            $registration = Registration::where('course_id', $courseId)
                            ->where('user_social_id', $studentSocialSecurityId)
                            ->first();

            if ($registration){

                $registration->diploma_path = $path;
                $registration->save();

                return $registration;
            } else{
                Log::error('No Registration found for security id '.$studentSocialSecurityId);
                return null;
            }

        }

    }