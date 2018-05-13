<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 06/05/2018
     * Time: 4:58 PM
     */

    return [

        'menu' => [
            'main_nav'          => 'MAIN NAVIGATION',
            'account_settings'  => 'ACCOUNT SETTINGS',
            'teachers'          => 'Teachers',
            'course'            => 'Courses',
            'institute'         => 'Institute',
            'profile'           => 'My Profile',
            'settings'          => [
                                'title' => 'Settings',
                                'user_management' => 'User Management',
                                'location' => [
                                    'title' => 'Location',
                                    'province'  => 'Province',
                                    'canton'    => 'Canton',
                                    'parroquia'    => 'PARROQUIA',
                                ],
            ]
        ],
        'location' => [
            'province' => [
                'index' => [
                    'page_header'=> 'Province',
                    'table_header' => 'Province List'
                ],
                'table' => [
                    'id'                => 'Id',
                    'province_name'     => 'Province',
                    'cantons'           => 'Cantons',
                    'action'            => 'Action'
                ]
            ],
            'canton' => [
                'index' => [
                    'page_header'       => 'Canton',
                    'table_header'      => 'Canton List'
                ],
                'table' => [
                    'province_name'     => 'Province',
                    'canton_name'       => 'Canton Name',
                    'canton_capital'    => 'Capital',
                    'district_name'     => 'District',
                    'district_code'     => 'Dist. Code',
                    'zone'              => 'Zone',
                    'action'            => 'Action'
                ]
            ],
            'parroquia' => [
                'index' => [
                    'page_header'       => 'Parroquia',
                    'table_header'      => 'Parroquia List'
                ],
                'table' => [
                    'province_name'     => 'Province',
                    'canton_name'       => 'Canton Name',
                    'parroquia'         => 'Parroquia',
                    'action'            => 'Action'
                ]
            ]


        ],
        'page' => [
            'teacher' => [
                'index' => [
                    'page_header'=> 'Teacher Portfolio',
                    'table_header' => 'Teacher Portfolio'
                ],
                'table' => [
                    'id'                => 'Id',
                    'security_id'       => 'Social Id',
                    'first_name'        => 'First name',
                    'last_name'         => 'Last name',
                    'email'             => 'Email',
                    'modal_id'          => 'Modal ID',
                    'action'            => 'Teacher Profile'
                ]
            ],
            'course' => [
                'index' => [
                    'page_header'=> 'Course Management',
                    'table_header' => 'Courses - Inspection Processes'
                ],
                'table' => [
                    'id'                => 'Id',
                    'course_id'         => 'Course Id',
                    'short_name'        => 'Short Name',
                    'hours'             => 'Hours',
                    'start_date'        => 'Start Date',
                    'end_date'          => 'End Date',
                    'quota'             => 'Quota',
                    'comment'           => 'Comment',
                    'action'            => 'Editor'
                ],
                'form'  =>[
                    'edit_title'        => 'Edit Course',
                    'add_title'         => 'Add New Course',
                    'course_id'         => 'Course Id',
                    'course_type'       => 'Course Type',
                    'course_modality'   => 'Modality',
                    'university'        => 'University',
                    'short_name'        => 'Short Name',
                    'hours'             => 'Hours',
                    'start_date'        => 'Start date',
                    'end_date'          => 'End date',
                    'quota'             => 'Quota',
                    'comment'           => 'Comment',
                    'description'       => 'Description'

                ]
            ],
            'university' => [
                'index' => [
                    'page_header'=> 'University Portfolio',
                    'table_header' => 'University Portfolio'
                ],
                'table' => [
                    'id'                => 'Id',
                    'name'              => 'Name',
                    'action'            => 'Action'
                ]
            ]

        ],
        'elements' => [
            'button' => [
                'edit'      => 'Edit',
                'create'    => 'Create',
                'delete'    => 'Delete',
                'remove'    => 'Remove',
                'close'     => 'Close'
            ],
        ],
        'words' =>[
            'zone'  => 'Zone'
        ]
    ];