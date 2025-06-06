<div>
    <button wire:click="toggleModal"
        class="cursor-pointer flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm hover:shadow-md">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Criar Proprietário
    </button>

    <div class="flex">
        <!-- Tabela -->
        <div class="w-1/2">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sigla</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descrição</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Logo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuário</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($proprietarios as $proprietario)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">{{ $proprietario->nome }}</td>
                            <td class="px-6 py-4">{{ $proprietario->sigla }}</td>
                            <td class="px-6 py-4">{{ $proprietario->descricao }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if ($proprietario->logo)
                                        <img src="{{ Storage::url($proprietario->logo) }}"
                                            alt="Logo {{ $proprietario->nome }}"
                                            class="w-20 h-20 object-cover rounded-full">
                                    @else
                                        <div
                                            class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center">
                                            <span class="text-gray-500">Sem logo</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $proprietario->user->id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal de Criação -->
        @if ($showCreateModal)
            <div class="fixed inset-0 backdrop-blur-sm transition-opacity flex items-center justify-center">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="flex flex-col items-center">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 mb-4">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Criar Novo Proprietário</h3>
                                <p class="text-sm text-gray-500 mb-6">Preencha os dados do novo proprietário</p>

                                <form wire:submit.prevent="create" class="w-full max-w-md"
                                    enctype="multipart/form-data">
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-medium mb-2">Nome</label>
                                        <div class="relative">
                                            <input type="text" wire:model.defer="nome"
                                                placeholder="Nome do proprietário"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 pl-10">
                                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </span>
                                        </div>
                                        @error('nome')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-medium mb-2">Sigla</label>
                                        <div class="relative">
                                            <input type="text" wire:model.defer="sigla"
                                                placeholder="Sigla do proprietário"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 pl-10">
                                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                                </svg>
                                            </span>
                                        </div>
                                        @error('sigla')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-medium mb-2">Descrição</label>
                                        <div class="relative">
                                            <textarea wire:model="descricao" placeholder="Descrição do proprietário"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 pl-10"></textarea>
                                            <span class="absolute top-3 left-0 pl-3 flex items-start">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                                </svg>
                                            </span>
                                        </div>
                                        @error('descricao')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-medium mb-2">Logo</label>
                                        <div class="relative" x-data="{ uploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="uploading = true"
                                            x-on:livewire-upload-finish="uploading = false"
                                            x-on:livewire-upload-cancel="uploading = false"
                                            x-on:livewire-upload-error="uploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                                            <input type="file" wire:model="logo" placeholder="URL do logo"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 pl-10">
                                            <div x-show="uploading">
                                                <progress max="100" x-bind:value="progress"></progress>
                                            </div>
                                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                                <svg class="h-5 w-5 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </span>
                                        </div>
                                        @error('logo')
                                            <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-6">
                                        <label class="block text-gray-700 text-sm font-medium mb-2">Usuários
                                            Responsáveis</label>
                                        <div>
                                            <label class="block mb-1">Usuários:</label>
                                            <select wire:model="user_id"
                                                class="border-2 border-gray-300 rounded-md p-2 w-full">
                                                <option value="">Selecione um usuário</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="flex justify-end space-x-3">
                                        <button type="button" wire:click="toggleModal"
                                            class="cursor-pointer px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Cancelar
                                        </button>
                                        <button type="submit"
                                            class="cursor-pointer px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Criar Proprietário
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
