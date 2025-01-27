<div>
    <div class="container-fluid mt-3">
        <div class="row flex-row flex-sm-nowrap py-3">
            @foreach($stages as $stage)
                @include('my-crm::livewire.kanban-board.stage', [
                    'stage' => $stage
                ])
            @endforeach
        </div>
    </div>

    <div wire:ignore>
        @includeWhen($sortable, 'my-crm::livewire.kanban-board.sortable', [
            'sortable' => $sortable,
            'sortableBetweenStages' => $sortableBetweenStages,
        ])
    </div>
</div>
