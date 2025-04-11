$(() =>{
    // function fetchPasien(keyword) {
    //     $.ajax({
    //         url: URL.getData,
    //         method: 'GET',
    //         dataType: 'json',
    //         success: function(response) {
    //             console.log(response, 'response');
                
    //             if (response.status) {
    //                 const data = response.data;
    //                 $('#no_rm').val(data.no_rm);
    //                 $('#no_register').val(data.no_register);
    //                 $('#nama').val(data.nama);
    //                 $('#alamat').val(data.alamat);
    //                 $('#alamat').val(data.alamat);
    //                 $('#jenis_kelamin').val(data.jenis_kelamin);
                    

    //                 console.log('Alamat:', data.alamat);
    //                 console.log('Jenis Kelamin:', data.jenis_kelamin);
    //             } else {
    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: 'Data Tidak Ditemukan',
    //                     text: response.message
    //                 });
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Gagal memuat data:', error);
    //         }
    //     });
    // }

    // let fillDokter = (obj) => {
    //     let wrapper = $('.custom-select-wrapper');
    //     let dropdown = wrapper.find('.custom-select-dropdown');
    //     let optionsList = wrapper.find('.custom-select-options');
    //     let display = wrapper.find('.custom-select-display');
    //     let search = wrapper.find('.custom-select-search');
    //     let hiddenInput = wrapper.find('#dokter_op');
    
    //     $.getJSON(obj.url, function(data, status) {
    //         let list = data.data || data.list;
    
    //         if (status === 'success') {
    //             optionsList.empty();
    //             list.forEach(item => {
    //                 let selected = (parseInt(obj.value) === parseInt(item.id));
    //                 let li = $(`<li data-id="${item.id}">${item.nama}</li>`);
    //                 if (selected) {
    //                     display.text(item.nama);
    //                     hiddenInput.val(item.id);
    //                 }
    //                 optionsList.append(li);
    //             });
    //         }
    
    //         search.on('keyup', function() {
    //             let keyword = $(this).val().toLowerCase();
    //             optionsList.find('li').each(function() {
    //                 let text = $(this).text().toLowerCase();
    //                 $(this).toggle(text.includes(keyword));
    //             });
    //         });
    
    //         optionsList.on('click', 'li', function() {
    //             let nama = $(this).text();
    //             let id = $(this).data('id');
    //             display.text(nama);
    //             hiddenInput.val(id);
    //             dropdown.hide();
    //         });
    
    //         display.off('click').on('click', function() {
    //             dropdown.toggle();
    //             search.focus();
    //         });
    
    //         $(document).on('click', function(e) {
    //             if (!$(e.target).closest('.custom-select-wrapper').length) {
    //                 dropdown.hide();
    //             }
    //         });
    //     });
    // };
    
    // fillDokter({
    //     url: URL.getDokter,
    //     value: null
    // });
    
    // $('#btnCariRM').on('click', function () {
    //     let keyword = $('#no_rm').val().trim();

    //     if (!keyword) {
    //         Swal.fire({
    //             icon: 'warning',
    //             title: 'Oops...',
    //             text: 'Silakan masukkan No. RM terlebih dahulu!',
    //             timer: 1000,
    //             showConfirmButton: false,
    //             timerProgressBar: true
    //         });
    //         return;
    //     }

    //     fetchPasien(keyword);
    // });

    Webcam.set({
        width: 1280,
        height: 720,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    let photoCount = 0;
    const maxPhotos = 20;

    $('#startBtn').on('click', function () {
        let nama = $('#nama').val().trim();
        let no_rm = $('#no_rm').val().trim();

        if (!nama || !no_rm) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Isi semua form terlebih dahulu!',
                timer: 1000,
                showConfirmButton: false,
                timerProgressBar: true
            });
            return;
        }

        $('#form-container').hide();
        $('#camera-container').css('display', 'block');
        Webcam.attach('#my_camera');
    });

    const shutterSound = document.getElementById('shutterSound');

    $('#backBtn').on('click', function () {
        window.location.reload();
    });

    $(document).on('contextmenu', function (e) {
        if (!$('#camera-container').is(':visible')) return;
        e.preventDefault();
    
        if (photoCount >= maxPhotos) {
            Swal.fire({
                icon: 'info',
                title: 'Batas Tercapai',
                text: 'Anda hanya bisa mengambil maksimal 8 foto.',
                timer: 1000,
                showConfirmButton: false,
                timerProgressBar: true
            });
            return;
        }
    
        let nama = $('#nama').val().trim();
        let no_rm = $('#no_rm').val().trim();
    
        if (!nama || !no_rm) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Tidak Lengkap',
                text: 'Nama dan No. RM harus diisi.',
                timer: 1500,
                showConfirmButton: false,
                timerProgressBar: true
            });
            return;
        }
    
        if (typeof shutterSound !== 'undefined') {
            shutterSound.currentTime = 0;
            shutterSound.play();
        }
    
        if (typeof Webcam !== 'undefined') {
            Webcam.snap(function (data_uri) {
                photoCount++;
    
                const imageElement = `<img src="${data_uri}" class="result-image" />`;
                $('#results').append(imageElement);
    
                $.post(URL.save_photo, {
                    nama: nama,
                    no_rm: no_rm,
                    image: data_uri
                }, function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response,
                        timer: 1000,
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                });
            });
        }
    });
    
    $('#table_pelaksanaan').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: URL.getData,
            type: "GET",
            dataSrc: 'data'
        },
        order: [[0, 'asc']],
        columns: [
            {
                data: null,
                className: 'text-center',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'no_rm',
                searchable: true,
                // className: 'text-center',
                render: function (data, type, row) {
                    return data ? data : 'N/A';
                }
            },
            {
                data: 'nama',
                searchable: false,
                // className: 'text-center',
                render: function (data, type, row) {
                    return data ? data : 'N/A';
                }
            },
            {
                data: 'created_at',
                searchable: false,
                className: 'text-center',
                render: function (data, type, row) {
                    return data ? data : 'N/A';
                }
            },
            {
                data: 'nama_dokter',
                searchable: false,
                className: 'text-center',
                render: function (data, type, row) {
                    return data ? data : 'N/A';
                }
            },
            {
                data: null,
                className: 'text-center',
                render: function (data, type, row) {
                    return `<button class="btn btn-primary btn-sm buat_laporan">Buat Laporan</button>`;
                }
            }
        ],
        
        language: {
            emptyTable: "No data available in the table"
        }
    });

    $('#table_pelaksanaan').on('click', '.buat_laporan', function () {
        var data = $('#table_pelaksanaan').DataTable().row($(this).parents('tr')).data();
        var uid = data.uid;
        console.log(data, 'data');
        window.location.href = `${base_url}pasien_detail/${uid}`;
        
        // fillForm(data);
    });
    
    function fillForm(data) {
        var uid = data.uid;
    
        $('#uid_pelaksana').val(uid);
    
        let payload = {
            uid: uid,
            uid_pelaksana: uid 
        };
    
        $.ajax({
            url: URL.get_pelaksana,
            type: 'GET',
            data: payload,
            dataType: 'json',
            success: function (response) {
                console.log(response, 'response');
    
                if (response.success) {
                    window.location.href = `${base_url}pasien_detail/${uid}`;
                } else {
                    alert('Error fetching data');
                }
            },
            error: function () {
                alert('Failed to fetch data');
            }
        });
    }
    
})