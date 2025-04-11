$(() =>{
    $('#table_management').on('click', '.btn-warning', function() {
        var data = $('#table_management').DataTable().row($(this).parents('tr')).data();
        fillModal(data);
    });

    // dataTable
    $('#table_management').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: URL.getData,
            type: "GET",
            dataSrc: 'data'
        },
        order: [[0, 'asc']],
        columns: [
            { data: null, render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }},
            { data: 'nip', searchable: true },
            { data: 'username', searchable: false, render: function(data, type, row) {
                
                return data ? data : 'N/A'; 
            }},
            { data: 'nama', searchable: true },
            { data: null, render: function (data, type, row) {
                return `<button class="btn btn-warning btn-sm">Edit</button>`;
            }}
        ],
        language: {
            emptyTable: "No data available in the table"
        }
    });
    
    function fillModal(data) {
        var uid = data.uid;
    
        $('#uid_management').val(uid);
    
        let browse = true;
    
        $.blockUI({ 
            message: '<div class="spinner"></div>',
            css: {
                border: 'none', 
                backgroundColor: 'transparent' 
            }
        });
    
        let Array = {
            uid: uid,
            uid_management: uid 
        };
    
        $.ajax({
            url: URL.get_management,
            type: 'GET',
            data: Array, 
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#nip').val(response.data.nip);
                    $('#nama').val(response.data.nama);
                    $('#unitKerja').val(response.data.unit_kerja);

                    $.unblockUI();
                    $('#tambah_management').modal('show');
                } else {
                    $.unblockUI();
                    alert('Error fetching data');
                }
            },
            error: function() {
                $.unblockUI();
                alert('Failed to fetch data');
            }
        });
    }
})