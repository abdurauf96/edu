<div class="form-group{{ $errors->has('room_number') ? 'has-error' : ''}}">
    <label for="room_number" class="control-label">{{ 'Xona raqami' }}</label>
    <input class="form-control" name="room_number" type="number" id="room_number" value="{{ $room->room_number ?? ''}}" >
    {!! $errors->first('room_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('room_capacity') ? 'has-error' : ''}}">
    <label for="room_capacity" class="control-label">{{ 'Xonada joylar soni' }}</label>
    <input class="form-control" name="room_capacity" type="number" id="room_capacity" value="{{ $room->room_capacity ?? ''}}" >
    {!! $errors->first('room_capacity', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
