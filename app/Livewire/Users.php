<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Users extends Component

{
  
    public $users;
    public $user;
    public $name;
    public $email;
    public $password;
    public $role_id;
    public $editingUserId;

    public $showEditModal = false;
    public $showCreateModal = false;
    public $userIdToDelete = null;
    public $confirmationDelete = false;

    public function mount()
    {
        $this->users = User::all();

    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required'
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role_id' => $this->role_id,
        ]);

        $this->reset(['name', 'email', 'password', 'role_id']);
        $this->showCreateModal = false;
        $this->users = User::all();
        session()->flash('message', 'Usuário criado com sucesso.');
    }

    public function edit($id)
    {
        $this->editingUserId = $id;
        $this->user = User::findOrFail($id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->role_id = $this->user->role_id;
        $this->showEditModal = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->editingUserId,
            'password' => 'nullable|min:6',
            'role_id' => 'required'
        ]);

        $user = User::findOrFail($this->editingUserId);
        
        $userData = [
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role_id,
        ];

        if (!empty($this->password)) {
            $userData['password'] = bcrypt($this->password);
        }

        $user->update($userData);

        $this->closeEditModal();
        session()->flash('message', 'Usuário atualizado com sucesso.');
        $this->users = User::all();
    }

    public function delete()
    {
        if ($this->userIdToDelete) {
            User::find($this->userIdToDelete)->delete();
        }
        $this->confirmationDelete = false;
        $this->userIdToDelete = null;
        $this->users = User::all();
    }

    public function teste(){
        dd("ta pegando");
    }

    public function confirmDelete($id)
    {
        $this->userIdToDelete = $id;
        $this->confirmationDelete = true;
    }

    public function showCreateModal()
    {
        $this->reset(['name', 'email', 'password', 'role_id']);
        $this->showCreateModal = true;
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
        $this->reset(['name', 'email', 'password', 'role_id']);
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->reset(['name', 'email', 'password', 'role_id', 'user', 'editingUserId']);
    }

    public function closeModal()
    {
        $this->confirmationDelete = false;
        $this->userIdToDelete = null;
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'password', 'role_id', 'user']);
    }

    public function render()
    {
        return view('livewire.users');
    }
}