<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\Service;
use App\Models\Category;
use Livewire\WithFileUploads;
class CreateService extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $skills;
    public $category;
    public $currency;
    public $price_type;
    public $price;
    public $location;
    public $latitude;
    public $longitude;
    public $image;

    public function render()
    {
        $categories = Category::all();
        return view('livewire.service.create-service', compact('categories'));
    }

    public function store(){
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'skills' => 'required',
            'category' => 'required',
            'currency' => 'required',
            'price_type' => 'required',
            'price' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            // 'image' => 'required',
        ]);

        $service = new Service();
        $service->name = $this->name;
        $service->description = $this->description;
        $service->skills = $this->skills;
        $service->currency = $this->currency;
        $service->price_type = $this->price_type;
        $service->price = $this->price;
        $service->location = $this->location;
        $service->latitude = $this->latitude;
        $service->longitude = $this->longitude;
        $service->save();


        if ($this->image) {
            $image = $this->image->store('services', 'public');
            $service->update(['image' => $image]);
        }

        $service->categories()->attach($this->category);


        session()->flash('message', 'Service created successfully.');
        return redirect('/auth/dashboard');

    }   

}
