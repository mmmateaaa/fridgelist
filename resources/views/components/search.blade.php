<form action="{{ route('search') }}"  method="get">
    <div class="input-group">
        <input type="search" name="search" class="form-control" placeholder="Search by name or category">
        <span class="input-group-prepend">
            <button type="submit" class="btn btn-primary">Search</button>
        </span>
    </div>
</form>