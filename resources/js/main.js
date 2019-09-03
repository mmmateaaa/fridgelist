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
