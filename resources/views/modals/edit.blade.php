<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product informations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('product.update') }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="product_id" value="">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Product name:</label>
                        <input name="name" id="name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="type_id" class="col-form-label">Product category:</label>
                        <select selected="null" class="form-control" id="type_id" name="type_id">
                            @foreach( $types as $type )
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="expires" class="col-form-label">Expires date:</label>
                        <input name="expires" id="expires" type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="col-form-label">Quantity:</label>
                        <input name="quantity" id="quantity" type="text" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
