<div class="form-group">
    <label for="name">类别名</label>
    <input type="text" name="name" id="name" value="{{ $data['name'] }}">
</div>

<div class="form-group">
    <label for="pid">父级</label>
    <select name="pid" id="pid">
        @foreach($types as $type)
            <option value="{{ $type->id }}" {{ $type->id == $data['pid'] ? 'selected' : '' }}>{{ $type->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="order">排序id</label>
    <input type="text" name="order" id="order" value="{{ $data['order'] }}">
</div>