<?php

namespace App\Http\Livewire\ShipManufacturers;

use App\Models\ShipManufacturer;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithFileUploads;

class ShipManufacturers extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public $manufacturers;
    public $manufacturerId;
    public $tag;
    public $name;
    public $description;
    public $asset;
    public $xplorer_tag;
    public $isOpen = false;

    public $rules = [
        'tag' => 'required|min:3|unique:ship_manufacturers,tag',
        'name' => 'required|min:4',
        'xplorer_tag' => 'required|min:4',
        'description' => 'required',
        'asset' => 'sometimes|image|max:2048'
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
        $this->xplorerTag = $manufacturer->xplorer_tag;
        $this->description = $manufacturer->description;

        $this->openModal();
    }

    public function store()
    {
        $validated = $this->validate([
            'tag' => 'required|min:3|unique:ship_manufacturers,tag,' . $this->manufacturerId,
            'name' => 'required|min:4',
            'xplorer_tag' => 'required|min:4',
            'description' => 'required',
            'asset' => 'sometimes|image|max:2048'
        ]);

        ShipManufacturer::updateOrCreate(['id' => $this->manufacturerId], [
            'tag' => $validated['tag'],
            'name' => $validated['name'],
            'xplorer_tag' => $validated['xplorer_tag'],
            'description' => $validated['description'],
            'asset' => $validated['asset']->store('public/uploads/ship_manufacturers'),
        ]);

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

    public function dashboard()
    {
        $this->redirect(route('admin.index'));
    }

    private function resetInputFields()
    {
        $this->tag = null;
        $this->name = null;
        $this->xplorer_tag = null;
        $this->manufacturerId = null;
        $this->asset = null;
    }
}
