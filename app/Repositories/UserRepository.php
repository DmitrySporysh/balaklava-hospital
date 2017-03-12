<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;

use App\Models\HealthWorker;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use DB;

class UserRepository extends Repository implements UserRepositoryInterface
{

    function model()
    {
        return 'App\Models\User';
    }

    public function createUserWithHealthWorker($health_worker, $user)
    {
        try {
            DB::transaction(function () use ($health_worker, $user) {
                Debugbar::info($user);
                $new_user = $this->create($user);
                Debugbar::info($new_user);

                $health_worker['login_id'] = $new_user['id'];
                Debugbar::info($health_worker);

                HealthWorker::create($health_worker);
            });

        } catch
        (Exception $e) {
            $message = 'Error while creating element using ' . $this->model() . "\n" . $e->getMessage();
            throw new DALException($message, 0, $e);
        }
    }


}