<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminNotifications extends Component
{
    protected $listeners = ['refreshNavBar' => '$refresh'];

    public function read($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);
        if($notification) {
            $notification->markAsRead();
            $this->emit('refreshNavBar');
        }
    }

    public function readAll()
    {
        $notification = auth()->user()->unreadNotifications()->get();
            $notification->markAsRead();
            $this->emit('refreshNavBar');
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Notifications was successfully cleared',
                'text' => '',
                ]);
    }

    public function render()
    {
        $notifications = auth()->user()->unreadNotifications()->take(5)->get();

        return view('livewire.admin.admin-notifications', compact('notifications'));
    }
}
