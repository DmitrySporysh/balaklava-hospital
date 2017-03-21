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
        $this->call(UserTableSeeder::class);
        $this->call(HospitalTableSeeder::class);
        $this->call(HospitalDepartmentsTableSeeder::class);
        $this->call(HealthWorkerTableSeeder::class);
        $this->call(DistrictDoctorTableSeeder::class);
        $this->call(ChambersTableSeeder::class);
        $this->call(PatientsTableSeeder::class);
        $this->call(InspectionsProtocolsTableSeeder::class);
        $this->call(ReceivedPatientsTableSeeder::class);
        $this->call(InpatientsTableSeeder::class);
        $this->call(StateDynamicTableSeeder::class);
        $this->call(DischargesTableSeeder::class);
        $this->call(OperationsTableSeeder::class);
        $this->call(ProceduresTableSeeder::class);
        $this->call(TemperatureLogTableSeeder::class);
        $this->call(AnalyzesTableSeeder::class);
        $this->call(MedicalAppointmentsTableSeeder::class);
        $this->call(NotesTableSeeder::class);
        $this->call(BindingHospitalDepartmentWithDepartmentChiefSeeder::class);
    }
}
