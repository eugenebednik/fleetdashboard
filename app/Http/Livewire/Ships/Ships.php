<?php

namespace App\Http\Livewire\Ships;

use App\Models\Ship;
use App\Models\ShipManufacturer;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Ships extends Component
{
    use AuthorizesRequests;

    public $ships;
    public $manufacturers;
    public $shipId;
    public $manufacturer;
    public $name;
    public $description;
    public $isOpen = false;
    public $isEditing = false;

    public $rules = [
        'manufacturer' => 'required|exists:ship_manufacturers,id',
        'name' => 'required|min:4',
        'description' => 'required',
    ];

    public function render()
    {
        $this->ships = Ship::all();
        $this->manufacturers = ShipManufacturer::all();
        return view('ships.show');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create()
    {
        $this->isEditing = false;
        $this->authorize('create', Ship::class);
        $this->openModal();
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $ship = Ship::findOrFail($id);

        $this->authorize('update', $ship);

        $this->shipId = $id;
        $this->manufacturer = $ship->manufacturer->id;
        $this->name = $ship->name;
        $this->name = $ship->name;
        $this->description = $ship->description;

        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        if (!$this->isEditing) {
            $ship = new Ship();
        } else {
            $ship = Ship::find($this->shipId);
        }

        $ship->manufacturer()->associate(ShipManufacturer::find($this->manufacturer));
        $ship->name = $this->name;
        $ship->description = $this->description;
        $ship->save();

        session()->flash('message', $this->shipId
            ? __('Ship updated.')
            : __('Ship created.')
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        $ship = Ship::find($id);

        $this->authorize('delete', $ship);

        $ship->delete();

        session()->flash('message', __('Ship deleted'));
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->isEditing = false;
    }

    private function resetInputFields()
    {
        $this->manufacturerId = null;
        $this->name = null;
        $this->description = null;
    }
}
