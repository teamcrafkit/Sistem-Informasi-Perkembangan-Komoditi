<?php

namespace App\View\Components;

use App\Models\Menu;
use App\Models\User;
use Illuminate\View\Component;
use Spatie\Permission\Models\Role;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $users       = User::find(auth()->user()->id);
        $roles       = Role::get();
        $navigations = Menu::with('children')->whereNull('parent_id')->orderBy('sort', 'ASC')->orderBy('id', 'ASC')->get();
        return view('components.sidebar', compact('users', 'roles', 'navigations'));
    }
}
