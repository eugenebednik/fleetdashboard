<?php

namespace App\Http\Livewire\ShipManufacturers;

use App\Models\ShipManufacturer;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShipManufacturers extends Component
{
    use AuthorizesRequests;

    public $manufacturers;
    public $manufacturerId;
    public $tag;
    public $name;
    public $description;
    public $isOpen = false;

    public $rules = [
        'tag' => 'required|min:3|unique:ship_manufacturers,tag',
        'name' => 'required|min:4',
        'description' => 'required',
    ];

    public function render()
    {
        $this->manufacturers = ShipManufacturer::all();
        return view('ship-manufacturers.show');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create()
    {
        $this->authorize('create', ShipManufacturer::class);
        $this->openModal();
    }

    public function edit($id)
    {
        $manufacturer = ShipManufacturer::findOrFail($id);

        $this->authorize('update', $manufacturer);

        $this->manufacturerId = $id;
        $this->tag = $manufacturer->tag;
        $this->name = $manufacturer->name;
        $this->description = $manufacturer->description;

        $this->openModal();
    }

    public function store()
    {
        $validated = $this->validate([
            'tag' => 'required|min:3|unique:ship_manufacturers,tag,' . $this->manufacturerId,
            'name' => 'required|min:4',
            'description' => 'required',
        ]);

        ShipManufacturer::updateOrCreate(['id' => $this->manufacturerId], $validated);

        session()->flash('message', $this->manufacturerId
            ? __('Manufacturer updated.')
            : __('Manufacturer created.')
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        $manufacturer = ShipManufacturer::find($id);

        $this->authorize('delete', $manufacturer);

        $manufacturer->delete();

        session()->flash('message', __('Manufacturer deleted'));
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->tag = null;
        $this->name = null;
        $this->manufacturerId = null;
    }
}
