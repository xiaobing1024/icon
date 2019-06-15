<div class="form-group">
    <label for="name">图标名</label>
    <input type="text" name="name" id="name" value="{{ $data['name'] }}">
</div>

<div class="form-group">
    <label for="type">所属分类</label>
    <select name="type" id="type">
        @foreach($types as $type)
            <option value="{{ $type->id }}" {{ $type->id == $data['type'] ? 'selected' : '' }}>{{ $type->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="width">宽度</label>
    <input type="text" name="width" id="width" value="{{ $data['width'] }}">
</div>

<div class="form-group">
    <label for="height">高度</label>
    <input type="text" name="height" id="height" value="{{ $data['height'] }}">
</div>

<div class="form-group">
    <label for="radius">圆角</label>
    <input type="text" name="radius" id="radius" value="{{ $data['radius'] }}">
</div>