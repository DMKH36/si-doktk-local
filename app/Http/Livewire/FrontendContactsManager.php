<?php

namespace App\Http\Livewire;

use App\Models\FrontendContact;
use Livewire\Component;

class FrontendContactsManager extends Component
{
    public $frontendcontacts;

    protected $rules = [
        'frontendcontacts.*.name' => 'required',
        'frontendcontacts.*.text' => 'required',
    ];

    public function render()
    {
        return view('livewire.frontend-contacts-manager');
    }

    public function mount()
    {
        $this->frontendcontacts = FrontendContact::all();
    }

    public function add()
    {
        $this->frontendcontacts->push(FrontendContact::make()->setConnection('mysql'));
    }

    public function delete($index)
    {
        $contact = $this->frontendcontacts[$index];
        $this->frontendcontacts->forget($index);

        $contact->delete();

        session()->flash('successContacts', 'Data Kontak berhasil dihapus!');
    }

    public function save()
    {
        $this->validate();

        foreach ($this->frontendcontacts as $contact) {
            $contact->save();
        }

        session()->flash('successContacts', 'Data Kontak berhasil diperbarui!');
    }

}
