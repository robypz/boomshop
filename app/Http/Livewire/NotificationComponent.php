<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;

class NotificationComponent extends Component
{
    use WithPagination;

    public $notifications,$count;

    protected $listeners = ['notification'];


    public function mount()
    {
        $this->notifications = auth()->user()->unreadNotifications;
        $this->count = auth()->user()->unreadNotifications->count();
    }

    public function render()
    {
        return view('livewire.notification-component');
    }

    public function read($notification_id)
    {
       $notification = auth()->user()->notifications()->findOrFail($notification_id);
       $notification->markAsRead();
       $this->mount();
    }

    public function notification()
    {
        $this->mount();
    }



}
