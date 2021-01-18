$(document).ready(function(){
    // 
    $('#admin_search').hide();

    // Event when keyword isnerted
    $('#admin_keyword').on('keyup', function(){
        // 
        $('.loader').show();

        // Ajax using load
        // $('container').load('ajax/mahasiswa.php?keyword=' + $('keyword').val());
    
        // Ajax using get
        $.get('ajax/adminlist.php?admin_keyword=' + $('#admin_keyword').val(), 
        function(mhs){
            $('#container').html(mhs);
            $('.loader').hide();
        });
    });
});


// // AJAX Method

// // Element Picking
// var keyword = document.getElementById('keyword');
// var search = document.getElementById('search');
// var container = document.getElementById('container');

// // Add event when typing keyword
// keyword.addEventListener('keyup', function(){
    
//     // Make object for AJAX
//     var ajax = new XMLHttpRequest();
    
//     // AJAX Respons Checking
//     ajax.onreadystatechange = function(){
//         // 4 == ready to serve, 200 == OK status
//         if(ajax.readyState == 4 && ajax.status == 200){
//             container.innerHTML = ajax.responseText;
//         }
//     }

//     // AJAX Execution
//     ajax.open('GET', 'ajax/mahasiswa.php?keyword=' + keyword.value, true);
//     ajax.send();
// });