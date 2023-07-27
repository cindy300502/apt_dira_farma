<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SellingReportPage extends Component
{

    // Binding Variable
    public $detail_state_id;

    // Listeners
    protected $listeners = [
        'setDetailState' => 'setDetailState'
    ];
    public function setDetailState($id) {
        $this->detail_state_id = $id;
    }

    public function mount() {
        $this->detail_state_id = '';
    }

    public function render()
    {
        return view('livewire.selling-report-page')->layout('layouts.admin_layout');
    }
}
