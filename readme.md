# Course Grade Management System [CGMS]
#### Build in Laravel 5.6

### Features
coming soon.

### Installation

Install package

    composer install
    php artisan migrate
    php artisan db:seed



### Run the Queue

When uploading diploma file in zip format, the system will store the zip file and a queue process `ExtractDiplomaFile` 
will start to extracting the zip file in a specific folder. After extracting, the process will find all the registrations
for that course and the users by filename, and will update their diploma file info.

    php artisan queue:work

### Nginx Configuration
Coming soon.