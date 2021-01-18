$(document).ready(function(){
    // 
    // $('#search_book').hide();
    // $('.loader').hide();
    
    // Event when keyword inserted
    $('#search_book').on('click', function(){
        // 
        // $('.loader').show();

        // Ajax using load
        // $('container').load('ajax/mahasiswa.php?keyword=' + $('keyword').val());
    
        // Ajax using get
        $.get('ajax/bookinglist.php?keyword=' + $('#keyword').val(), 
        function(mhs){
            $('#container').html(mhs);
            
            // $('.loader').hide();
        });
    });
});
