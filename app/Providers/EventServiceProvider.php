<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //Asignamos sus menu de acuerdo al rol
        Event::listen(BuildingMenu::class,function(BuildingMenu $event){
            //admin
            if(Auth()->user()->tipo_user=='AD'){
                 $event->menu->add(
                    [
                        'text'    => 'Gestión admin',
                        'icon'    => 'fas fa-fw fa-share',
                        'submenu' => [
                            [
                                'text' => 'Registrar Usuario',
                                'url'  => '/home',
                                'icon' => 'far fa-circle nav-icon',
                                
                            ],
                            [
                                'text'        => 'Emails',
                                'url'         => 'gestion/mail',
                                'icon'        => 'far fa-circle nav-icon',
                                'label_color' => 'success',
                                
                            ],
                        ],
                    ],
                    
                );
            }

            //user
            if(Auth()->user()->tipo_user=='US'){
                 $event->menu->add(
                   
                     [
                        'text'    => 'Gestión Emails',
                        'icon'    => 'fas fa-fw fa-share',
                        'submenu' => [
                           
                            [
                                'text'        => 'Emails',
                                'url'         => 'gestion/mail',
                                'icon'        => 'far fa-circle nav-icon',
                                'label_color' => 'success',
                                
                            ],
                        ],
                    ],
                );
            }
 
        });
       
       
        parent::boot();

        //
    }
}
