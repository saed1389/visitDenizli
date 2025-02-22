$(function (){
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Emin misin?',
            text: 'Bu Veriler Silinsin mi?',
            icon: 'warning',
            showCancelButton: true,
            showDenyButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonText: 'İptal',
        }).then((result)=> {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Silindi!',
                    'Dosyanız silinir.',
                    'success'
                )
            }
        })
    });

    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        var v_date = $(this).attr("v-data");

        Swal.fire({
            title: v_date+' onaylamasını ister misiniz?',
            text: ' ',
            icon: 'warning',
            showCancelButton: true,
            showDenyButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Onayla!',
            cancelButtonText: 'İptal',
        }).then((result)=> {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'onaylandı!',
                    'Başvuru onaylandı.',
                    'success'
                )
            }
        })
    });
});
