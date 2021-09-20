@foreach ($groups as $group)
<option value=""></option>
    <option value="{{ $group->id }}" >{{ $group->name }}</option>
@endforeach