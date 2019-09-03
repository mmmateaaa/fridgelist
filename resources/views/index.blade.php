@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-1 col-10">
                <h2 style="text-align: center;"><a style="text-decoration: none;" href="{{ url('index') }}">MY FRIDGE LIST</a></h2>
                <div class="row">
                    <div class="col-4">
                        <button class="btn btn-primary btn-style" data-toggle="modal" data-target="#add">Add new product</button>
                    </div>
                    <div class="offset-3 col-5">
                        @include('components.search')
                    </div>

                </div>
                @if( Session::has('message') )
                    <div class="alert alert-success" id="alert" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <article>
                    <ul class="list-group">
                        @if(count($products) <= 0)
                            <p class="no-result">Your list is currently empty. Add new product to your fridgelist.</p>
                        @endif
                        @include('components.list')
                    </ul>
                </article>
            </div>

            @include('modals.add')
            @include('modals.edit')
            @include('modals.delete')

        </div>
    </div>
@stop

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        ///edit product
        $('#edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var name = button.data('name')
            var expires = button.data('expires')
            var type = button.data('type')
            var quantity = button.data('quantity')
            var product_id = button.data('productid')
            var modal = $(this)
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #expires').val(expires);
            modal.find('.modal-body #type_id').val(type);
            modal.find('.modal-body #quantity').val(quantity);
            modal.find('.modal-body #product_id').val(product_id);
        })

        //delete product
        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var product_id = button.data('productid')
            var modal = $(this)
            modal.find('.modal-body #product_id').val(product_id);
        })

        //alert for store or delete product
        $("#alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#alert").slideUp(500);
        });

    });
</script>
