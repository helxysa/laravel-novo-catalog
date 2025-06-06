<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proprietario;
use App\Models\User;
use Livewire\WithFileUploads;

class Proprietarios extends Component
{
    use WithFileUploads;

    public $users;
    public $proprietarios;
    public $nome;
    public $sigla;
    public $descricao;
    public $logo;
    public $user_id;
    public $showCreateModal = false;

    public function mount()
    {
        $this->proprietarios = Proprietario::all();
        $this->users = User::all();
    }

    public function create()
    {
     

        Proprietario::create([
            'nome' => $this->nome,
            'sigla' => $this->sigla,
            'descricao' => $this->descricao,
            'logo' => $this->logo->store('logos', 'public'),
            'user_id' => $this->user_id,
        ]);

        $this->reset();
        $this->proprietarios = Proprietario::all();
    }

    public function toggleModal()
    {
        $this->showCreateModal = !$this->showCreateModal;
    }

    public function render()
    {
        return view('livewire.proprietarios');
    }
}
