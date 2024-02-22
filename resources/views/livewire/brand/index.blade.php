<div>
   @include('livewire.brand.modal-form')
    <div class="row">
        <div class="col md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Brands List
                        <a href="" data-bs-toggle="modal" data-bs-target="#addBrandModal" class="btn btn-primary btn-sm float-end">Add Brands</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Famille</td>
                            <td>Slug</td>
                            <td>Status</td>
                            <td>Action</td>
                            </tr>
                        </thead>

                    <tbody>
                        @foreach ($brands as $brand)
                        <tr>
                            <td>{{  $brand->id }}</td>
                            <td>{{  $brand->name }}</td>
                            <td>
                                @if($brand->category)
                                {{  $brand->category->name }}
                                @else
                                    No Category
                                @endif
                            </td>
                            <td>{{  $brand->slug }}</td>
                            <td>{{  $brand->status == '1'?'hidden':'visible' }}</td>
                            <td>
                                <a href="#" wire:click="editBrand({{  $brand->id  }})" data-bs-toggle="modal" data-bs-target="#updateBrandModal"  class="btn btn-sm btn-success">EDIT</a>
                                <a href="#" wire:click="deleteBrand({{  $brand->id  }})" data-bs-toggle="modal" data-bs-target="#deleteBrandModal"   class="btn btn-sm btn-danger">DELETE</a>
                            </td>
                        </tr>


                        @endforeach

                    </tbody>
                </table>
                <div>
                    {{ $brands->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')

<script>
    window.addEventListener('close-modal', event =>{

        $('#addBrandModal').modal('hide');
        $('#updateBrandModal').modal('hide');
        $('#deleteBrandModal').modal('hide');
    });
</script>

@endpush
