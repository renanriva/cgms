<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 06/05/2018
     * Time: 4:58 PM
     */

    return [

        'menu' => [
            'main_nav'          => 'NAVEGACIÓN PRINCIPAL',
            'account_settings'  => 'CONFIGURACIONES DE LA CUENTA',
            'teachers'          => [
                'title'         => 'Maestros',
                'all'            => 'Lista de Maestros',
                'portfolio'     => 'Portafolio del Docente',
                'registration_inspection'  => 'Inspección de Registro',
            ],
            'course'            => [
                'title'             => 'Cursos',
                'all'               => 'Lista de Cursos',
                'upcoming_courses'  => 'Próximos cursos',
                'my_courses'        => 'Mis cursos',

            ],
            'user'              => [
                'my_portfolio'  => 'Mi Portafolio',
                'my_requests'  => 'Solicitudes de Registro'
            ],
            'university'        => 'Universidad',
            'profile'           => 'Mi perfil',
            'settings'          => [
                'title' => 'Settings',
                'user_management' => 'Gestión de usuarios',
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
                    'page_header'=> 'Portafolio del docente',
                    'table_header' => 'Portafolio del docente'
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
                    'course_type'       => 'Course Type',
                    'course_name'       => 'Course Name',
                    'modality'          => 'modality',
                    'hours'             => 'Hours',
                    'start_date'        => 'Start Date',
                    'end_date'          => 'End Date',
                    'approved'          => 'Approved',
                    'certificate'       => 'Certificate',
                    'diploma'           => 'Diploma',

                    'action'            => 'Action',
                ],
                'form' => [
                    'edit_title'        => 'Editar profesor',
                    'add_title'         => 'Agregar nuevo maestro',
                ]

            ],
            'teacher_profile' => [
                'index' => [
                    'page_header'=> 'Perfil del profesor',
                    'table_header' => 'Perfil del profesor'
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
                    'page_header'=> 'Dirección del curso',
                    'table_header' => 'Cursos - Procesos de inspección'
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
                    'state'             => 'State',
                    'upload_rating'     => 'Upload Rating',
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
                    'registrations'     => 'Registrations',
                    'inspection_file_message' => 'After creating the course, you can upload inspection file.'

                ],
            ],
            'upcoming' => [
                'index' => [
                    'page_header'=> 'Próximo curso',
                    'table_header' => 'Mis cursos registrables'
                ],
                'table' => [
                    'course_code'       => 'Course Code',
                    'course_type'       => 'Course Type',
                    'short_name'        => 'Course',
                    'institution'       => 'University',
                    'modality'          => 'Modality',
                    'start_date'        => 'Start Date',
                    'end_date'          => 'End Date',
                    'hours'             => 'Hours',
                    'action'            => 'Register'
                ]

            ],
            'register' => [
                'index' => [
                    'page_header'=> 'Registrar curso',
                    'table_header' => 'Registrar curso'
                ],
            ],
            'registration' => [
                'all' => [
                    'index' => [
                        'page_header'=> 'Examinar registros',
                        'table_header' => 'Lista de inscripciones'
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
                'pending' => [
                    'index' => [
                        'page_header'=> 'Buscar curso',
                        'table_header' => 'Registros pendientes',

                    ],
                    'table' => [
                        'course_code'       => 'Course Code',
                        'short_name'        => 'Short Name',
                        'institute'         => 'Institute',
                        'start_date'        => 'Start Date',
                        'end_date'          => 'End Date',
                        'security_id'       => 'Social Id',
                        'name'              => 'Name',
                        'email'             => 'Email',
                        'terms_condition'   => 'Terms & Condition',
                        'record_uploaded'   => 'Record Uploaded',
                        'is_approved'       => 'Approved',
                        'approved_by'       => 'Approved By',
                        'action'            => 'Action'
                    ]
                ]
            ],
            'university' => [
                'index' => [
                    'page_header'=> 'Portafolio de la Universidad',
                    'table_header' => 'Portafolio de la Universidad'
                ],
                'table' => [
                    'id'                => 'Id',
                    'name'              => 'Name',
                    'email'             => 'Email',
                    'login_name'        => 'Login Name',
                    'login_email'       => 'Login Email',
                    'website'           => 'Website',
                    'phone'             => 'Phone',
                    'created_by'        => 'Created By',
                    'created_at'        => 'Created At',
                    'action'            => 'Action'
                ],
                'form'  =>[
                    'edit_title'        => 'Editar Universidad',
                    'add_title'         => 'Agregar nueva universidad',
                    'name'              => 'Name',
                    'email'             => 'Email',
                    'login_name'        => 'Login Name',
                    'login_email'       => 'Login Email',
                    'website'           => 'Website',
                    'phone'             => 'Phone',
                    'note'              => 'Note',
                    'profile_photo'     => 'Profile Photo',
                    'login_message'     => 'These login information will be used to create login user for university.'
                ],
                'view' => [
                    'table_header'      => 'Lista de cursos'
                ]

            ],
            'user' => [
                'index' => [
                    'page_header'=> 'Gestión de usuarios',
                    'table_header' => 'Lista de todos los usuarios'
                ],
                'table' => [
                    'id'                => 'Id',
                    'first_name'        => 'First Name',
                    'last_name'         => 'Last Name',
                    'email'             => 'Email',
                    'role'              => 'Role',
                    'status'            => 'Status',
                    'creation_type'     => 'Creation Type',
                    'created_at'        => 'Created At',
                    'action'            => 'Action'
                ],
                'form'  =>[
                    'edit_title'        => 'Edit User',
                    'add_title'         => 'Add New User',
                    'first_name'        => 'First Name',
                    'last_name'         => 'Last Name',
                    'email'             => 'Email',
                    'role'              => 'Role',
                    'status'            => 'Status',
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
                'upload_diploma' => 'Diploma',
                'upload_course_request' => 'Cargar solicitud de curso', // in course list page
                'new_course_upload' => 'Cargar un nuevo curso' // in course list page
            ],
        ],
        'words' =>[
            'diploma' => 'Diploma',
            'grade' => 'Grado',
            'zone'  => 'Zona',
            'last_updated' => 'Última actualización',
            'by' => 'por',
        ],
        'messages' => [
            'create_course' => 'Crear curso',
            'grade_approved_by' => 'Grado aprobado por',
            'proceed_to_the_course' => 'Proceda al curso',
            'upload_new_course' => 'Cargar un nuevo curso',
            'download_sample_file' => 'Descargar archivo de muestra',
            'upload_diploma_zip_file' => 'Upload Diploma Zip File',
            'course_request_list_modal' => 'Course Request List Modal'
        ]
    ];