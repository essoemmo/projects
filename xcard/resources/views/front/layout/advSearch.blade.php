
<!------
<form action="{{ route('advSearch') }}">
    <input type="search" name="search" class="form-control rounded-0" placeholder="{{ _i('Search Here') }}">
    <div class="inner-title">{{ _i('Price') }}</div>
    <div class="d-flex justify-content-between">
        <input type="number" name="from" class="form-control rounded-0"> -
        <input type="number" name="to" class="form-control rounded-0">
    </div>
    <div class="inner-title">{{ _i('Country') }}</div>
    <select name="region_id" class="form-control rounded-0">
        <option disabled selected>{{ _i('Select') }}</option>
        @foreach(regions() as $region)
            <option value="{{ $region->id }}">{{ $region->title }}</option>
        @endforeach
    </select>
    <input type="submit" class="btn btn-yellow rounded-0 w-100 mt-4" value="{{ _i('Search') }}">
</form>
-------->
