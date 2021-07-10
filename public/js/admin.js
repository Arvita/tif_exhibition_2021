$(document).ready(function(){
    $('#datatable-example').DataTable();

    $('.select2').select2({
        theme: 'bootstrap4',
    });
    
    $('.select2nosearch').select2({
        theme: 'bootstrap4',
        minimumResultsForSearch: -1,
    });

    // Summernote
    $('.textarea').summernote()

    setDatatable('#datauser', '/admin/user/json', 'desc', [
            { data: 'id', width: '10%', 'class': 'text-center'},
            { data: 'name'},
            { data: 'email'},
            { data: 'username'},
            { data: 'avatar', 'class': 'text-center'},
            { data: 'role'},
            { data: 'button', width: '15%', 'class': 'text-center'}
        ]
    );

    setDatatable('#dataproduct', '/admin/product/json', 'asc', [
            { data: 'id', width: '5%', 'class': 'text-center'},
            { data: 'group_name', width: '15%'},
            { data: 'group_leader', width: '10%'},
            { data: 'group_leader_nim', 'class': 'none'},
            { data: 'group_member', 'class': 'none'},
            { data: 'group_email', 'class': 'none'},
            { data: 'group_phone', 'class': 'none'},
            { data: 'semester_class', 'class': 'text-center', width: '5%'},
            { data: 'title', width: '20%'},
            { data: 'description', 'class': 'none'},
            { data: 'category', 'class': 'none'},
            { data: 'platform', 'class': 'none'},
            { data: 'featured_picture', 'class': 'none'},
            { data: 'link_video', 'class': 'text-center', width: '5%'},
            { data: 'link_web', 'class': 'none'},
            { data: 'link_mobile', 'class': 'none'},
            { data: 'link_desktop', 'class': 'none'},
            { data: 'link_instagram', 'class': 'none'},
            { data: 'screenshot', 'class': 'none'},
            { data: 'button', width: '10%', 'class': 'text-center'}
        ]
    );
    
    $(".datatables tbody").on('click', 'td .hapus-btn', function(event){
        $('#delete-form').attr('action', $(this).data('href'));
    });
});

function setDatatable(element, url, order, columns) {
    $(element).DataTable({
        processing: true,
        serverSide: false,
        order: [0, order],
        pageLength: 10,
        ajax: {
            url: url,
            dataType: 'json',
            type: 'GET',
        },
        columns: columns,
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
            $('#showgambar').attr('src', e.target.result);
        }
  
        reader.readAsDataURL(input.files[0]);
    }
}
  
$("#avatar, #picture").change(function () {
    readURL(this);
});


$(".alert").fadeTo(2000,500).slideUp(500, function(){
    $(".alert").slideUp(500);
});

$("#link_video").change(function () {
    $("#youtube_link").attr("href", 'https://youtu.be/'+$(this).val());
    $("#showthumbnail").attr("src", 'https://img.youtube.com/vi/'+$(this).val()+'/0.jpg');
});

$("#link_instagram").change(function () {
    $("#instagram-embed-0").attr("src", $(this).val()+'embed');
});

function readSSURL(input, number) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
            $('#showss'+number).attr('src', e.target.result);
        }
  
        reader.readAsDataURL(input.files[0]);
    }
}

$('input[name^="ss_"').change(function () {
    readSSURL(this, $(this).data('id'))
});