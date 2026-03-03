jQuery(document).ready(function($){

    $('#wse-select-all').on('click', function(){
        $('.wse-product').prop('checked', this.checked);
    });

    $('#wse-search').on('keyup', function(){
        let value = $(this).val().toLowerCase();
        $('.wse-table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    function exportProducts(ids){
        let form = $('<form>', {
            method: 'POST',
            action: wseData.ajax_url
        });

        form.append($('<input>', {type:'hidden', name:'action', value:'wse_export_products'}));
        form.append($('<input>', {type:'hidden', name:'nonce', value:wseData.nonce}));

        ids.forEach(function(id){
            form.append($('<input>', {type:'hidden', name:'ids[]', value:id}));
        });

        $('body').append(form);
        form.submit();
    }

    $('#wse-export-selected').click(function(){
        let ids = [];
        $('.wse-product:checked').each(function(){
            ids.push($(this).val());
        });
        exportProducts(ids);
    });

    $('#wse-export-all').click(function(){
        exportProducts([]);
    });

});