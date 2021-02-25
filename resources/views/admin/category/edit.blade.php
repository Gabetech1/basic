<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
        </h2>
    </x-slot>

    <div class="py-12">
       <div class="container">
           <div class="row">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Category</div>
                <div class="card-body">
                    <form action="{{ url('category/update/'.$category->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Update Category Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $category->category_name }}">
                            @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button class="btn btn-primary">Update Category</button>
                    </form>

                </div>

            </div>
        </div>
           </div>
       </div>
    </div>
</x-app-layout>
