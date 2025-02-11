<?php

namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Helpers\CountryHelper;
use App\Models\User;
use Spatie\Permission\Models\Role;
class Singup extends Component
{
    public $countries;
    
    public $name;
    public $email;
    public $password;
    public $confirmpassword;
    public $phone;
    public $country;
    public $account_type;

    public function mount()
    {
        $this->countries = CountryHelper::getAllCountries();
    }

    public function render()
    {
        return view('livewire.auth.singup');
    }

    public function register()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirmpassword' => 'required|same:password',
            'phone' => 'required',
            'country' => 'required',
            'account_type' => 'required'
        ]);

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->phone = $this->phone;
        $user->country = $this->country;
        $user->account_type = $this->account_type;
        $user->save();

        $role = Role::findByName($this->account_type);
        $user->assignRole($role);
        
        session()->flash('message', 'User created successfully.');
        return $this->redirect('/auth', navigate: false);
    }
}
