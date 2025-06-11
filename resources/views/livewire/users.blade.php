<div class="container mx-auto px-4 py-8" x-data="{ showCreateModal: false, showEditModal: false, showDeleteModal: false, id: null }" @user-created.window="showCreateModal = false">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Gerenciamento de Usuários</h1>
            <p class="text-gray-600">Administre os usuários do sistema</p>
        </div>
        <button @click="showCreateModal = true"
            class="cursor-pointer flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm hover:shadow-md">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16 21v-2a4 4 0 00-3-3.87M12 7a4 4 0 110-8 4 4 0 010 8zm6 8v2a2 2 0 01-2 2h-4a2 2 0 01-2-2v-2a2 2 0 012-2h4a2 2 0 012 2z" />
            </svg>
            Novo Usuário
        </button>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
        <div class="flex items-center p-4 bg-gray-50 border-b">
            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-4a4 4 0 11-8 0 4 4 0 018 0zm6 4v2a2 2 0 01-2 2h-4a2 2 0 01-2-2v-2a2 2 0 012-2h4a2 2 0 012 2z" />
            </svg>
            <span class="font-medium text-gray-700">Total de usuários: {{ count($users) }}</span>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Papel</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data de Criação</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $user->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                        <span class="text-blue-600 font-medium">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $user->name }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center text-sm text-gray-500">
                                    <!-- Ícone Mail SVG -->
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 12a4 4 0 01-8 0 4 4 0 018 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14v7m0 0H9m3 0h3" />
                                    </svg>
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if ($user->role_id == 2)
                                        <!-- Diretor -->
                                        <svg class="w-4 h-4 text-green-600 mr-1" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="2" fill="none" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                                        </svg>
                                        <span
                                            class="ml-2 px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Diretor</span>
                                    @elseif($user->role_id == 1)
                                        <!-- Administrador -->
                                        <svg class="w-4 h-4 text-blue-600 mr-1" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 11c0-1.104.896-2 2-2s2 .896 2 2-.896 2-2 2-2-.896-2-2-2z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19v-7" />
                                        </svg>
                                        <span
                                            class="ml-2 px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Administrador</span>
                                    @else
                                        <!-- Usuário -->
                                        <svg class="w-4 h-4 text-gray-500 mr-1" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="2" fill="none" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                                        </svg>
                                        <span
                                            class="ml-2 px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Usuário</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"
                                            stroke="currentColor" stroke-width="2" fill="none" />
                                        <line x1="16" y1="2" x2="16" y2="6"
                                            stroke="currentColor" stroke-width="2" />
                                        <line x1="8" y1="2" x2="8" y2="6"
                                            stroke="currentColor" stroke-width="2" />
                                        <line x1="3" y1="10" x2="21" y2="10"
                                            stroke="currentColor" stroke-width="2" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <button  @click="id = {{ $user->id }}; showEditModal = true"
                                        class="cursor-pointer text-green-500 hover:text-green-700 p-1 rounded-full hover:bg-green-50 transition-colors"
                                        title="Editar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button class="text-gray-400 hover:text-red-500 cursor-pointer"
                                        @click="id = {{ $user->id }}; showDeleteModal = true">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if (count($users) === 0)
            <div class="py-12 text-center text-gray-500 flex flex-col items-center">
                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-4a4 4 0 11-8 0 4 4 0 018 0zm6 4v2a2 2 0 01-2 2h-4a2 2 0 01-2-2v-2a2 2 0 012-2h4a2 2 0 012 2z" />
                </svg>
                <p>Nenhum usuário encontrado</p>
            </div>
        @endif


        <div x-show="showEditModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 backdrop-blur-sm transition-opacity flex items-center justify-center"
            @keydown.escape.window="showEditModal = false" @click.self="showEditModal = false">
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
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Editar Usuário</h3>
                            <p class="text-sm text-gray-500 mb-6">Atualize as informações do usuário</p>

                            <form wire:submit.prevent="update(id)" class="w-full max-w-md">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-medium mb-2">Nome
                                        Completo</label>
                                    <div class="relative">
                                        <input type="text" wire:model.defer="name"
                                            placeholder="Nome completo do usuário"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 pl-10">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('name')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                                    <div class="relative">
                                        <input type="email" wire:model.defer="email"
                                            placeholder="email@exemplo.com"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 pl-10">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('email')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-medium mb-2">Nova Senha
                                        (opcional)</label>
                                    <div class="relative">
                                        <input type="password" wire:model.defer="password"
                                            placeholder="Deixe em branco para manter a senha atual"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 pl-10">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('password')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label class="block text-gray-700 text-sm font-medium mb-2">Papel do
                                        Usuário</label>
                                    <div class="relative">
                                        <select wire:model.defer="role_id"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 pl-10 appearance-none">
                                            <option value="">Selecione um papel</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Usuário</option>
                                        </select>
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('role_id')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="flex justify-end space-x-3">
                                    <button type="button" @click="showEditModal = false"
                                        class="cursor-pointer px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Cancelar
                                    </button>
                                    <button type="submit"
                                        class="cursor-pointer px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Salvar Alterações
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal de Criação --}}
        <div x-show="showCreateModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" @keydown.escape.window="showCreateModal = false"
            @click.self="showCreateModal = false"
            class="fixed inset-0 backdrop-blur-sm transition-opacity flex items-center justify-center">
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
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Registrar Novo Usuário</h3>
                            <p class="text-sm text-gray-500 mb-6">Apenas administradores podem registrar novos
                                usuários</p>

                            <form wire:submit.prevent="create" class="w-full max-w-md">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-medium mb-2">Nome
                                        Completo</label>
                                    <div class="relative">
                                        <input type="text" wire:model.defer="name"
                                            placeholder="Nome completo do usuário"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 pl-10">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('name')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                                    <div class="relative">
                                        <input type="email" wire:model.defer="email"
                                            placeholder="email@exemplo.com"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 pl-10">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('email')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-medium mb-2">Senha</label>
                                    <div class="relative">
                                        <input type="password" wire:model.defer="password" placeholder="Senha"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 pl-10">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('password')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label class="block text-gray-700 text-sm font-medium mb-2">Papel do
                                        Usuário</label>
                                    <div class="relative">
                                        <select wire:model.defer="role_id"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 pl-10 appearance-none">
                                            <option value="">Selecione um papel</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Usuário</option>
                                        </select>
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('role_id')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="flex justify-end space-x-3">
                                    <button type="button" @click="showCreateModal = false"
                                        class="cursor-pointer px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Cancelar
                                    </button>
                                    <button type="submit"
                                        class="cursor-pointer px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Criar Usuário
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal de Delete --}}
        <div x-show="showDeleteModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 backdrop-blur-sm transition-opacity flex items-center justify-center"
            @keydown.escape.window="showDeleteModal = false" @click.self="showDeleteModal = false">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 rounded-lg" @click.stop>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Deletar esse </h3>
                    <p class="text-sm text-gray-500 mb-6">Tem certeza que deseja deletar este usuário?</p>
                    <div class="flex justify-end space-x-3">
                        <button type="button" @click="showDeleteModal = false"
                            class="cursor-pointer px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancelar
                        </button>
                        <button type="button" @click="$wire.delete(id); showDeleteModal = false"
                            class="cursor-pointer px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Deletar
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
