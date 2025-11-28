@props(['item'])

<tr class="hover">

    {{-- Checkbox --}}
    <td>
        <input class="checkbox checkbox-sm" type="checkbox" />
    </td>

    {{-- Code --}}
    <td>
        <div class="font-mono text-sm">{{ $item->code }}</div>
    </td>

    {{-- Name + Description --}}
    <td>
        <div class="font-medium">{{ $item->name }}</div>
        @if ($item->description)
            <div class="text-xs text-base-content/70">
                {{ Str::limit($item->description, 50) }}
            </div>
        @endif
    </td>

    {{-- Type --}}
    <td>
        @if ($item->type === 'benefit')
            <x-badge color="success" size="sm">Benefit</x-badge>
        @else
            <x-badge color="error" size="sm">Cost</x-badge>
        @endif
    </td>

    {{-- Unit --}}
    <td>
        <span class="text-sm">{{ $item->unit ?: '-' }}</span>
    </td>

    {{-- Status --}}
    <td>
        @if ($item->active)
            <x-badge color="primary" size="sm">Active</x-badge>
        @else
            <x-badge color="ghost" size="sm">Inactive</x-badge>
        @endif
    </td>

    {{-- Actions --}}
    <td class="text-right">
        <div class="flex justify-end gap-1">

            {{-- View --}}
            <a class="btn btn-ghost btn-xs btn-circle" href="
                title="View">
                <x-lucide-eye class="w-4 h-4" />
            </a>

            {{-- Edit --}}
            <a class="btn btn-ghost btn-xs btn-circle" href=""
                title="Edit">
                <x-lucide-pencil class="w-4 h-4" />
            </a>

            {{-- Delete --}}
            <form method="POST" action="
                onsubmit="return confirm('Delete this criteria?')">
                @csrf
                @method('DELETE')

                <button class="btn btn-ghost btn-xs btn-circle text-error" title="Delete">
                    <x-lucide-trash class="w-4 h-4" />
                </button>
            </form>

        </div>
    </td>

</tr>
