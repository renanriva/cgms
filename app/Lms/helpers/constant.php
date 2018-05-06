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

    /**
     * USER TYPE
     */
    const USER_STATUS_ACTIVE = 1;
    const USER_STATUS_INACTIVE = 0;

    /**
     * USER CREATION
     */
    const USER_CREATION_TYPE_REGISTRATION = 1;
    const USER_CREATION_TYPE_CMS = 2;               // USER CREATED IN CMS BY SOMEONE
    const USER_CREATION_TYPE_IMPORT = 3;            // USER IMPORTED FROM EXCEL FILE
