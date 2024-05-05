<?php

namespace App\Livewire;

use App\Mail\StatusUpdateNotification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class StatusConfirmation extends Component
{
    public $user;
    public $status;

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);
        $this->status = $this->user->status;
    }

    public function updateStatus()
    {
        $this->validate([
            'status' => 'required|in:confirmed,pending,gagal',
        ]);

        // Update status user
        $this->user->update(['status' => $this->status]);

        // Jika status adalah 'confirmed', tambahkan timestamp email_verified_at
        if ($this->status === 'confirmed') {
            $this->user->update(['email_verified_at' => Carbon::now()]);
        }

        // Kirim email notifikasi
        Mail::to($this->user->email)->send(new StatusUpdateNotification($this->status));

        // Redirect atau lakukan tindakan lain setelah mengirim email
    }

    public function render()
    {
        return view('livewire.status-confirmation');
    }
}
