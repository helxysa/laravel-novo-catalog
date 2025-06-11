<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On;

class Users extends Component

{
  
    public $users;
    public $user;
    public $name;
    public $email;
    public $password;
    public $role_id;

    public $showEditModal = false;
    public $showCreateModal = false;
    public $showDeleteModal = false;
    public function mount()

    {
        $this->users = User::all();

    }

    public function create()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required|in:1,2'
        ], [
            'name.required' => 'O nome é obrigatório',
            'name.min' => 'O nome deve ter no mínimo 3 caracteres',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'Digite um email válido',
            'email.unique' => 'Este email já está em uso',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres',
            'role_id.required' => 'Selecione um papel para o usuário',
            'role_id.in' => 'Papel inválido'
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role_id' => $this->role_id,
        ]);

        $this->reset(['name', 'email', 'password', 'role_id']);
        $this->users = User::all();
        session()->flash('message', 'Usuário criado com sucesso');
        
        // Só fecha o modal se passou pela validação
        $this->dispatch('user-created');
    }


   public function update($id){

    try {
        
        $user = User::findOrFail($this->id);
    } catch (\Execption $e) {
        session()->flash('error', 'Error ao atualizar o usuário' . $e->getMessage());
    }
    
    



    
   }

   public function delete($id)
   {
    try {
        $user = User::findOrFail($id);  
        $user->delete();
        $this->users = User::all();
        session()->flash('message', 'Usuário deletado com sucesso');

    } catch (\Exception $e) {
        session()->flash('error', 'Erro ao deletar o usuário' . $e->getMessage());
    }
   }

   

    public function render()
    {
        return view('livewire.users');
    }
}