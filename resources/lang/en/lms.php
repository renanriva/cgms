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
            'university'        => 'University',
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
                    'name'              => 'Name',
                    'email'             => 'Email',
                    'moodle_id'          => 'Id Moodle',
                    'university'        => 'University',
                    'function'          => 'Function',
                    'location'          => 'Address',
                    'province'          => 'Province',
                    'canton'            => 'Canton',
                    'district'          => 'District',
                    'action'            => 'Action'
                ]
            ],
            'teacher_profile' => [
                'index' => [
                    'page_header'=> 'Teacher Profile',
                    'table_header' => 'Teacher Portfolio'
                ],
                'table' => [
                    'course_type'       => 'Course Type',
                    'course_name'       => 'Course Name',
                    'institute'         => 'University',
                    'modality'          => 'Modality',
                    'hours'             => 'Hours',
                    'start_date'        => 'Start Date',
                    'end_date'          => 'End Date',
                    'status'            => 'Status',
                    'certificate'       => 'Certificate',
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
                    'course_id'         => 'Course Code',
                    'course_type'       => 'Course Type',
                    'course_modality'   => 'Modality',
                    'university'        => 'University',
                    'short_name'        => 'Short Name',
                    'hours'             => 'Hours',
                    'start_date'        => 'Start date',
                    'end_date'          => 'End date',
                    'quota'             => 'Quota',
                    'comment'           => 'Comment',
                    'description'       => 'Description',
                    'terms_condition'   => 'Terms & Condition',
                    'video'             => 'Video Information',
                    'video_type'        => 'Video Type',
                    'video_embed'       => 'Embed Code',
                    'data_update'       => 'Data Update Tab Info',
                    'inspection_file_message' => 'After creating the course, you can upload inspection file.'

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
                    'created_by'        => 'Created By',
                    'created_at'        => 'Created At',
                    'action'            => 'Action'
                ],
                'form'  =>[
                    'edit_title'        => 'Edit University',
                    'add_title'         => 'Add New University',
                    'name'              => 'Name',
                ]

            ]

        ],
        'elements' => [
            'button' => [
                'edit'      => 'Edit',
                'create'    => 'Create',
                'delete'    => 'Delete',
                'remove'    => 'Remove',
                'close'     => 'Close',
                'import'    =>  'Import',
                'upload'    =>  'Upload',
                'upload_course_request' => 'Upload Course Request' // in course list page
            ],
        ],
        'words' =>[
            'zone'  => 'Zone'
        ]
    ];