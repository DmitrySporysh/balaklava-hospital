<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        $this->call(HospitalTableSeeder::class);
        $this->call(HealthWorkerTableSeeder::class);
        $this->call(DistrictDoctorTableSeeder::class);
        $this->call(HospitalDepartmentsTableSeeder::class);
        $this->call(ChambersTableSeeder::class);
        $this->call(PatientsTableSeeder::class);
        $this->call(InspectionsProtocolsTableSeeder::class);
        $this->call(ReceivedPatientsTableSeeder::class);
        $this->call(InpatientsTableSeeder::class);
        $this->call(InspectionsTableSeeder::class);
        $this->call(DischargesTableSeeder::class);
        $this->call(OperationsTableSeeder::class);
        $this->call(DressingsTableSeeder::class);
        $this->call(AnalyzesTableSeeder::class);
        $this->call(MedicalAppointmentsTableSeeder::class);
    }
}
