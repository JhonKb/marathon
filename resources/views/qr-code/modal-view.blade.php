<div class="flex flex-col justify-items-center">
    <div class="p-6 bg-white rounded-lg">
        {!! QrCode::size(300)->generate(json_encode(['id' => $record->id, 'race-id' => $record->race->id, 'name' => $record->name])) !!}
    </div>
</div>
