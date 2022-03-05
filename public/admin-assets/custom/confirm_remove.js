function confirm_remove1(url, tag, name) {
    Swal.fire({
        title: `Bạn có thực sự muốn xóa ${tag} "${name}"?`,
        // showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Đồng ý',
        cancelButtonText: `Hủy`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            window.location.href = url
        }
    })
}
function confirm_remove(url, tag, name) {
    Swal.fire({
        title: `Bạn có thực sự muốn xóa ${tag} "${name}"?`,
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Huỷ',
        confirmButtonText: 'Đồng ý'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Xoá thành công!',
                '',
                'success'
            )
            setTimeout(() => {
                window.location.href = url
            }, 800);

        }
    })
}