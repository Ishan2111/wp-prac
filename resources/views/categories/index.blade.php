<h1>Categories</h1>
<a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add Category</a>

<ul class="list-group">
    @foreach ($categories as $category)
        <li class="list-group-item">
            <div class="row">
                <div class="col">{{ $category->name }}</div>
                <div class="col-auto">
                    <!-- Toggle Active Button -->
                    <form action="{{ route('categories.toggle', $category) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-sm btn-{{ $category->active ? 'danger' : 'success' }}">
                            {{ $category->active ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                </div>
            </div>
        </li>
    @endforeach
</ul>
