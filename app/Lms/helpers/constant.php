<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 06/05/2018
     * Time: 2:39 PM
     */


    /**
     * USER ROLE
     */
    const USER_ROLE_ADMIN = 5;
    const USER_ROLE_UNIVERSITY = 4;
    const USER_ROLE_STUDENT = 3;
    const USER_ROLE_VOID = 0;

    const USER_ROLE  = [
        0 => 'void',
        3 => 'teacher',
        4 => 'university',
        5 => 'admin'
    ];

    function getUserRole($value){
        return USER_ROLE[$value];
    }

    /**
     * USER TYPE
     */
    const USER_STATUS_ACTIVE = 1;
    const USER_STATUS_INACTIVE = 0;

    const USER_STATUS = [
        0 => 'inactive',
        1 => 'active'
    ];

    function getUserStatus($value){
        return USER_STATUS[$value];
    }

    /**
     * USER CREATION
     */
    const USER_CREATION_TYPE_REGISTRATION = 1;
    const USER_CREATION_TYPE_CMS = 2;               // USER CREATED IN CMS BY SOMEONE
    const USER_CREATION_TYPE_IMPORT = 3;            // USER IMPORTED FROM EXCEL FILE
    const USER_CREATION = [

        1 => 'Registration',
        2 => 'CMS',
        3 => 'Import'
    ];
    function getUserCreationType($id){
        return USER_CREATION[$id];
    }



    /**
     * REGISTRATION
     */

    const REGISTRATION_IS_APPROVED = 1;
    const REGISTRATION_IS_NOT_APPROVED = 0;

    const REGISTRATION_REGISTRY_IS_GENERATED = 1;
    const REGISTRATION_REGISTRY_IS_NOT_GENERATED = 0;

    const REGISTRATION_ACCEPT_TERMS_AND_CONDITION = 1;
    const REGISTRATION_NOT_ACCEPTED_TERMS_AND_CONDITION = 0;


    const REGISTRATION_STATUS_INCOMPLETE = 0;
    const REGISTRATION_STATUS_STARTED = 1;
    const REGISTRATION_STATUS_ACCEPT = 2;
    const REGISTRATION_STATUS_SIGNED = 3;
    const REGISTRATION_STATUS_COMPLETE = 5;

    const REGISTRATION_ACCEPT_TERMS_AND_CONDITION_FALSE = 0;
    const REGISTRATION_ACCEPT_TERMS_AND_CONDITION_TRUE = 1;

    /**
     * COURSE VIDEO TYPE
     */

    const COURSE_VIDEO_TYPE_YOUTUBE = 'youtube';
    const COURSE_VIDEO_TYPE_VIMEO = 'vimeo';
    const COURSE_VIDEO_TYPE_UPLOADED = 'uploaded';


    /**
     * Course REQUEST
     */
    const COURSE_REQUEST_VOID       = 0;
    const COURSE_REQUEST_CREATED    = 1;
    const COURSE_REQUEST_ACCEPTED   = 2;
    const COURSE_REQUEST_REJECTED   = 3;
