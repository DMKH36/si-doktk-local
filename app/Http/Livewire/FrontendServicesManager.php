<?php

namespace App\Http\Livewire;

use App\Models\FrontendService;
use Livewire\Component;

class FrontendServicesManager extends Component
{
    public $frontendservices;

    protected $rules = [
        'frontendservices.*.text' => 'required',
    ];

    public function render()
    {
        return view('livewire.frontend-services-manager');
    }

    public function mount()
    {
        $this->frontendservices = FrontendService::all();
    }

    public function add()
    {
        $this->frontendservices->push(FrontendService::make()->setConnection('mysql'));
    }

    public function delete($index)
    {
        $service = $this->frontendservices[$index];
        $this->frontendservices->forget($index);

        $service->delete();

        session()->flash('successServices', 'Data Layanan berhasil dihapus!');
    }

    public function save()
    {
        $this->validate();

        foreach ($this->frontendservices as $service) {
            $service->save();
        }

        session()->flash('successServices', 'Data Layanan berhasil diperbarui!');
    }
}
