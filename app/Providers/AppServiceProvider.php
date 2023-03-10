<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer(['livewire.idp.idp-show','livewire.training.training-show','livewire.idp.idp-reports', 'livewire.attendance.attendance-reports'], function ($view) {

            if(auth()->user()->teacher == 'Yes')
            {
                $list = DB::table('competencies')
                ->where('teaching','=', 1)
                ->orderBy('competency_group','asc')
                ->get();
            }else
            {
                $list = DB::table('competencies')
                ->where('nonteaching','=', 1)
                ->orderBy('competency_group','asc')
                ->get();
            }
            $comp = $list->groupBy('competency_group')->toArray();



            
            $view->with('comps', $comp);
        });

        View::composer(['livewire.user.User-show', 'livewire.user.profile'], function ($view) {

            if (auth()->user()->role_as == 3) {
                $info = [];
                $info += ['name' => 'No Supervisor'];
                $info += ['supId' => null];
                $info += ['college_name' => 'LND'];
                $view->with('info', $info);
            }else{
                $users = User::select('users.id As user_id','supervisor','college_id')
                ->join('colleges', 'colleges.id', '=', 'users.college_id')
                ->where('college_id',auth()->user()->college_id)
                ->first();
            if($users->supervisor){
                $list = User::select('name','college_name')
                ->join('colleges', 'colleges.id', '=', 'users.college_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('users.id','=', $users->supervisor)
                ->first();
                $info = $list->toArray();
                $info += ['supId' => $users->supervisor];
            }else{
                $list = User::select('college_name')
                ->join('colleges', 'colleges.id', '=', 'users.college_id')
                ->where('college_id',auth()->user()->college_id)
                ->first();

                $info = $list->toArray();
                $info += ['name' => 'No Supervisor'];
                $info += ['supId' => null];
                }
            
                $view->with('info', $info);
            }
            



            
        });


        
    }
}
