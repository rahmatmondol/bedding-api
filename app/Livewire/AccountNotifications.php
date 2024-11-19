<?php

namespace App\Livewire;

use Livewire\Component;

class AccountNotifications extends Component
{
    public $read;
    public $unread;
    public $notifications;


    public function mount()
    {
        $notifications = auth()->user()->notifications;
        $this->notifications = $notifications;
        $this->read = $notifications->whereNotNull('read_at');
        $this->unread = $notifications->whereNull('read_at');
        // dd($this->read);
    }

    public function render()
    {
        return view('livewire.account-notifications');
    }

    public function notification_read($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        $notification->markAsRead();

        return $this->redirect($notification->data['route'], navigate: true);
    }
}
