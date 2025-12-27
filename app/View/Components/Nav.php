<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
class Nav extends Component
{
    public $items;
    public $active;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
        $this->items=$this->ability_check(config('nav'));//config('nav');
        $this->active=Route::currentRouteName();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav');
    }
    protected function ability_check($items)
    {
        $user=Auth::user();
        foreach($items as $key=>$item){
           
            if(isset($item['ability']) && !$user->can($item['ability'])){
                unset($items[$key]);
            }
        }
        return $items;
    }
}