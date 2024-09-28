<div class="flex flex-col justify-items-center">
    <div class="p-6 bg-white rounded-lg">
        {!! QrCode::size(300)->generate(json_encode(['race-id' => $record->race->id, 'id' => $record->id, 'name' => $record->name])) !!}
    </div>
</div>
