<form action="{{ route('settings.update') }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    @foreach($settings as $setting)
        <div class="form-group">
            <label for="{{ $idAttr = str_slug($setting->label) }}">{{ $setting->label }}</label>
            <input name="{{ $setting->key }}"type="text" class="form-control" id="{{ $idAttr }}" value="{{ old($setting->key, $setting->value) }}">
        </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Submit</button>
</form>