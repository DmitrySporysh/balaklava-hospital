<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function bindRepositories()
    {
        //binding repositories
        $this->app->bind('App\Repositories\Interfaces\AnalysisRepositoryInterface',
            'App\Repositories\AnalysisRepository');

        $this->app->bind('App\Repositories\Interfaces\ChamberRepositoryInterface',
            'App\Repositories\ChamberRepository');

        $this->app->bind('App\Repositories\Interfaces\DischargeRepositoryInterface',
            'App\Repositories\DischargeRepository');

        $this->app->bind('App\Repositories\Interfaces\DistrictDoctorRepositoryInterface',
            'App\Repositories\DistrictDoctorRepository');

        $this->app->bind('App\Repositories\Interfaces\ProcedureRepositoryInterface',
            'App\Repositories\ProcedureRepository');

        $this->app->bind('App\Repositories\Interfaces\HealthWorkerRepositoryInterface',
            'App\Repositories\HealthWorkerRepository');

        $this->app->bind('App\Repositories\Interfaces\HospitalDepartmentRepositoryInterface',
            'App\Repositories\HospitalDepartmentRepository');

        $this->app->bind('App\Repositories\Interfaces\InpatientRepositoryInterface',
            'App\Repositories\InpatientRepository');

        $this->app->bind('App\Repositories\Interfaces\InspectionProtocolRepositoryInterface',
            'App\Repositories\InspectionProtocolRepository');

        $this->app->bind('App\Repositories\Interfaces\InspectionRepositoryInterface',
            'App\Repositories\InspectionRepository');

        $this->app->bind('App\Repositories\Interfaces\MedicalAppointmentRepositoryInterface',
            'App\Repositories\MedicalAppointmentRepository');

        $this->app->bind('App\Repositories\Interfaces\NoteRepositoryInterface',
            'App\Repositories\NoteRepository');

        $this->app->bind('App\Repositories\Interfaces\OperationRepositoryInterface',
            'App\Repositories\OperationRepository');

        $this->app->bind('App\Repositories\Interfaces\PasswordResetRepositoryInterface',
            'App\Repositories\PasswordResetRepository');

        $this->app->bind('App\Repositories\Interfaces\PatientRepositoryInterface',
            'App\Repositories\PatientRepository');

        $this->app->bind('App\Repositories\Interfaces\ReceivedPatientRepositoryInterface',
            'App\Repositories\ReceivedPatientRepository');

        $this->app->bind('App\Repositories\Interfaces\UserRepositoryInterface',
            'App\Repositories\UserRepository');



        //binding services
        $this->app->bind('App\Services\Interfaces\AuthorizationServiceInterface',
            'App\Services\AuthorizationService');

        $this->app->bind('App\Services\Interfaces\DepartmentChiefServiceInterface',
            'App\Services\DepartmentChiefService');

        $this->app->bind('App\Services\Interfaces\DoctorServiceInterface',
            'App\Services\DoctorService');

        $this->app->bind('App\Services\Interfaces\EmergencyServiceInterface',
            'App\Services\EmergencyService');

        $this->app->bind('App\Services\Interfaces\FileServiceInterface',
            'App\Services\FileService');

        $this->app->bind('App\Services\Interfaces\NurseServiceInterface',
            'App\Services\NurseService');

        $this->app->bind('App\Services\Interfaces\PasswordServiceInterface',
            'App\Services\PasswordService');

        $this->app->bind('App\Services\Interfaces\PatientServiceInterface',
            'App\Services\PatientService');

        $this->app->bind('App\Services\Interfaces\RegistrationServiceInterface',
            'App\Services\RegistrationService');

    }

    public function register()
    {
        $this->bindRepositories();
    }
}