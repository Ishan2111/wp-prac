<h1>Create Category</h1>
<a href="{{ route('categories.view') }}" class="btn btn-primary mb-3">View Categories</a>
<br>
<br>
<form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <div class="mb-3">
        <label for="parent_id" class="form-label">Parent Category</label>
        <select class="form-select" id="parent_id" name="parent_id">
            <option value="">Select Parent Category</option>
            @foreach ($options as $option)
                <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
