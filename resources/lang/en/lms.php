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
            'students'          => 'Students',
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