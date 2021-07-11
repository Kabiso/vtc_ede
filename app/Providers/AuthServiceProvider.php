<?php

namespace App\Providers;
use App\staff;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

         /**
        * Define Gate for  staff role
        * Returns true if staff role is set to each role
        **/ 
       Gate::define('sysAdmin', function($staff) {
           return $staff->jobtitles_id == '1';
       });
       
        Gate::define('manager', function($staff) {
            return $staff->jobtitles_id == '1' || $staff->jobtitles_id == '2';
        });

        Gate::define('acct', function($staff) {
            return $staff->jobtitles_id == '1' || $staff->jobtitles_id == '4' || $staff->jobtitles_id == '2';
        });

        Gate::define('normalStaff', function($staff) {
            return $staff->jobtitles_id == '1' || $staff->jobtitles_id == '2' ||  $staff->jobtitles_id == '3' || $staff->jobtitles_id == '5' ||  $staff->jobtitles_id == '6' || $staff->jobtitles_id == '8' ;
        });

        


    }
}
