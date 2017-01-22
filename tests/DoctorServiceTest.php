<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DoctorServiceTest extends TestCase
{

    use DatabaseTransactions;
    use WithoutMiddleware;


    public function testAddingAnalysisDoctorServiceMethod()
    {
        $doctorService = $this->app->make('App\Services\DoctorService');

        $response = $doctorService->addNewInpatientAnalysis(array (
            'analysis_name' => 'aaaaaaaaa',
            'analysis_description' => 'aaaaaaaaaaaa',
            'inpatient_id' => '20',
        )  ,19);

        $this->assertEquals($response['success'], true);
    }

    /*public function testAddingAnalysisPostRequest()
    {
        $user = factory(App\Models\User::class)->create();

        $this->actingAs($user)
            //->withSession(['foo' => 'bar'])
            ->post('/api/doctor/addAnalysis', ['analysis_name' => 'fsf', 'analysis_description' => 'fghjk','inpatient_id' => '20'])
            ->seeJson([
                'success' => false,
            ]);
    }*/
}
