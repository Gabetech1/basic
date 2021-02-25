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
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            <div class="card">
                <div class="card-header">All Categories</div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Serial No.</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">User</th>
                    <th scope="col">Created At</th>
                  </tr>
                </thead>
                <tbody>

                    @php($i = 1)
                    @foreach($categories as $category)
                    <tr>
                        <th scope="row"> {{ $categories->firstItem()+$loop->index }}</th>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->user->name }}</td>
                        @if( $category->created_at == NULL)
                        <td><span class="text-danger">No date set</span></td>
                        @else
                        <td>{{ $category->created_at->diffForHumans() }}</td>
                        @endif

                        <td>
                            <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                            <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a>
                         </td>
                    </tr>
                    @endforeach

                </tbody>
              </table>
              {{ $categories->links() }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add Category</div>
                <div class="card-body">
                    <form action="{{ route('store.category') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control">
                            @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button class="btn btn-primary">Add Category</button>
                    </form>

                </div>

            </div>
        </div>
           </div>
       </div>


       {{-- Trash Part --}}
       <div class="container">
        <div class="row">

     <div class="col-md-8">

         <div class="card">
             <div class="card-header">Trash List</div>
         <table class="table">
             <thead>
               <tr>
                 <th scope="col">Serial No.</th>
                 <th scope="col">Category Name</th>
                 <th scope="col">User</th>
                 <th scope="col">Created At</th>
               </tr>
             </thead>
             <tbody>

                 @php($i = 1)
                 @foreach($trashCat as $category)
                 <tr>
                     <th scope="row"> {{ $categories->firstItem()+$loop->index }}</th>
                     <td>{{ $category->category_name }}</td>
                     <td>{{ $category->user->name }}</td>
                     @if( $category->created_at == NULL)
                     <td><span class="text-danger">No date set</span></td>
                     @else
                     <td>{{ $category->created_at->diffForHumans() }}</td>
                     @endif

                     <td>
                         <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info">Restore</a>
                         <a href="{{ url('pdelete/category/'.$category->id) }}" class="btn btn-danger">P Delete</a>
                      </td>
                 </tr>
                 @endforeach

             </tbody>
           </table>
           {{ $trashCat->links() }}
         </div>
     </div>

     <div class="col-md-4">

     </div>
        </div>
    </div>
    </div>
</x-app-layout>
