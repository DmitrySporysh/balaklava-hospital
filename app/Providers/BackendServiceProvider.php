<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function boot(){

    }
    
    public function bindRepositories()
    {
        //binding repositories

        $this->app->bind( 'App\Repositories\Interfaces\BedRepositoryInterface',
                          'App\Repositories\BedRepository' );

        $this->app->bind( 'App\Repositories\Interfaces\ChamberRepositoryInterface',
                          'App\Repositories\ChamberRepository' );


        $this->app->bind( 'App\Repositories\Interfaces\DischargeRepositoryInterface',
                          'App\Repositories\DischargeRepository' );

        $this->app->bind( 'App\Repositories\Interfaces\DistrictDoctorRepositoryInterface',
                          'App\Repositories\DistrictDoctorRepository');

        $this->app->bind( 'App\Repositories\Interfaces\DressingRepositoryInterface',
                          'App\Repositories\DressingRepository' );

        $this->app->bind( 'App\Repositories\Interfaces\HealthWorkerRepositoryInterface',
                          'App\Repositories\HealthWorkerRepository' );

        $this->app->bind( 'App\Repositories\Interfaces\HospitalDepartmentRepositoryInterface',
                          'App\Repositories\HospitalDepartmentRepository' );

        $this->app->bind( 'App\Repositories\Interfaces\HospitalRepositoryInterface',
                          'App\Repositories\HospitalRepository' );

        $this->app->bind( 'App\Repositories\Interfaces\InspectionRepositoryInterface',
                          'App\Repositories\InspectionRepository' );

        $this->app->bind( 'App\Repositories\Interfaces\OperationRepositoryInterface',
                          'App\Repositories\OperationRepository' );

        $this->app->bind( 'App\Repositories\Interfaces\PasswordResetRepositoryInterface',
                          'App\Repositories\PasswordResetRepository' );

        $this->app->bind( 'App\Repositories\Interfaces\PatientRepositoryInterface',
                          'App\Repositories\PatientRepository' );

        $this->app->bind( 'App\Repositories\Interfaces\SurveyRepositoryInterface',
                          'App\Repositories\SurveyRepository' );

        $this->app->bind( 'App\Repositories\Interfaces\SurveyTypeRepositoryInterface',
                          'App\Repositories\SurveyTypeRepository' );

        $this->app->bind( 'App\Repositories\Interfaces\TreatmentRepositoryInterface',
                          'App\Repositories\TreatmentRepository' );

        $this->app->bind( 'App\Repositories\Interfaces\UserRepositoryInterface',
                          'App\Repositories\UserRepository' );


        $this->app->bind( 'App\Repositories\Interfaces\InpatientRepositoryInterface',
                          'App\Repositories\InpatientRepository' );

        $this->app->bind( 'App\Repositories\Interfaces\InspectionProtocolRepositoryInterface',
                          'App\Repositories\InspectionProtocolRepository' );

        $this->app->bind( 'App\Repositories\Interfaces\ReceivedPatientRepositoryInterface',
                          'App\Repositories\ReceivedPatientRepository' );

        //binding services


        $this->app->bind( 'App\Services\Interfaces\AttendingDoctorServiceInterface',
            'App\Services\AttendingDoctorService' );

        $this->app->bind( 'App\Services\Interfaces\AuthorizationServiceInterface',
                          'App\Services\AuthorizationService' );

        $this->app->bind( 'App\Services\Interfaces\CheifMedicalOfficerServiceInterface',
                          'App\Services\CheifMedicalOfficerService' );

        $this->app->bind( 'App\Services\Interfaces\FileServiceInterface',
                          'App\Services\FileService' );

        $this->app->bind( 'App\Services\Interfaces\HealthWorkerServiceInterface',
                          'App\Services\HealthWorkerService' );

        $this->app->bind( 'App\Services\Interfaces\NurseServiceInterface',
                          'App\Services\NurseService' );


        $this->app->bind( 'App\Services\Interfaces\PasswordServiceInterface',
                          'App\Services\PasswordService' );

        $this->app->bind( 'App\Services\Interfaces\PatientServiceInterface',
                          'App\Services\PatientService' );

        $this->app->bind( 'App\Repositories\Interfaces\RegistrationServiceInterface',
                          'App\Repositories\RegistrationService' );

        $this->app->bind( 'App\Repositories\Interfaces\UserServiceInterface',
                          'App\Repositories\UserService' );

    }
    public function register()
    {
        $this->bindRepositories();
    }
}