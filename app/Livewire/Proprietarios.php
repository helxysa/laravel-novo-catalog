<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proprietario;
use App\Models\User;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

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
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $editing_id;
    public $proprietario_id;
    public $selected_proprietario;
    public $editId;
    
    protected $rules = [
        'nome' => 'required|string|max:255',
        'sigla' => 'required|string|max:10',
        'descricao' => 'nullable|string',
        'logo' => 'nullable|image|max:2048',
        'user_id' => 'nullable|exists:users,id'
    ];

    public function mount()
    {
        $this->proprietarios = Proprietario::all();
        $this->users = User::all();
    }

    public function create()
    {
            if ($this->logo) {
                $logoPath = $this->logo->store('logos', 'public');
            }
         
            Proprietario::create([
                'nome' => $this->nome,
                'sigla' => $this->sigla,
                'descricao' => $this->descricao,
                'logo' => $logoPath,
                'user_id' => $this->user_id,
            ]);

            $this->reset(['nome', 'sigla', 'descricao', 'logo', 'user_id']);
            $this->proprietarios = Proprietario::all();
            
            $this->dispatch('proprietario-created');
            session()->flash('message', 'Proprietário criado com sucesso.');

    }

    public function delete($id)
    {
        try {
            $proprietario = Proprietario::findOrFail($id);
            $proprietario->delete();
            $this->proprietarios = Proprietario::all();
            session()->flash('message', 'Proprietário deletado com sucesso.');
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao deletar proprietário: ' . $e->getMessage());
        }
    }

    public function startEdit($id)
    {
        $proprietario = Proprietario::findOrFail($id);
        $this->editId = $id;
        $this->nome = $proprietario->nome;
        $this->sigla = $proprietario->sigla;
        $this->descricao = $proprietario->descricao;
        $this->user_id = $proprietario->user_id;
    }

    public function update()
    {
        $this->validate();

        try {
            $proprietario = Proprietario::findOrFail($this->editId);
            
            $data = [
                'nome' => $this->nome,
                'sigla' => $this->sigla,
                'descricao' => $this->descricao,
                'user_id' => $this->user_id,
            ];

            if ($this->logo) {
                $data['logo'] = $this->logo->store('logos', 'public');
            }

            $proprietario->update($data);
            
            $this->proprietarios = Proprietario::all();
            $this->reset(['nome', 'sigla', 'descricao', 'logo', 'user_id', 'editId']);
            
            $this->dispatch('proprietario-updated');
            session()->flash('message', 'Proprietário atualizado com sucesso.');
            
            $this->js('showEditModal = false');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao atualizar proprietário: ' . $e->getMessage());
        }
    }

    public function clone(Proprietario $proprietario)
    {
        Proprietario::create($proprietario->replicate()->except('id'));
        $this->proprietarios = Proprietario::all();
    }




    public function render()
    {
        return view('livewire.proprietarios');
    }
}
