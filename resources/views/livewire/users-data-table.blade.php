<div>
    <div class="w-full mb-4 flex flex-row justify-between items-center">
        <div class="w-full max-w-md">
            <x-input icon="magnifying-glass" placeholder="Search" wire:model.live.debounce.500ms="search" />
        </div>
        <x-button icon="plus" wire:click="$dispatch('openModal')" positive>Add new</x-button>
    </div>
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-xl border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Full name
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Email address
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        Last Activity
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="bg-neutral-primary-soft border-b  border-default">
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            {{ $user->first_name . ' ' . $user->last_name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        @php
                            $roles = [
                                1 => 'Administrator',
                                2 => 'Laborant',
                                3 => 'Read Only',
                            ];
                        @endphp
                        <td class="px-6 py-4">
                            {{ $roles[$user->role] ?? 'Nepoznata uloga' }}
                        </td>
                        <td class="px-6 py-4 flex flex-row items-center gap-2">
                            @if ($user->last_activity == 'Active')
                                <div class="relative flex items-center w-2 h-2">
                                    <span
                                        class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-cyan-500 animate-ping"></span>
                                    <span class="relative inline-flex w-2 h-2 rounded-full bg-cyan-500"></span>
                                </div>
                            @else
                                <div class="relative flex items-center w-2 h-2">
                                    <span
                                        class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-red-500 animate-ping"></span>
                                    <span class="relative inline-flex w-2 h-2 rounded-full bg-red-500"></span>
                                </div>
                            @endif
                            {{ $user->last_activity }}
                        </td>
                        <td class="px-6 text-right">
                            <x-button secondary xs icon="pencil"
                                wire:click="$dispatch('openModal', { user_id: {{ $user->id }} })" label="Edit" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="my-4 px-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
