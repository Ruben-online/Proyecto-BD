function nombre(nombre, apellido) {
    Swal.fire({
        title: 'Editar nombre',
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        showLoaderOnConfirm: true,
        html: '<input id="nombre" class="swal2-input">' +
            '<input id="apellido" class="swal2-input">',
        preConfirm: (login) => {
            return fetch(
                    nombre = $("#nombre").val(),
                    apellido = $("#apellido").val()


                    `user/nombre/` + nombre
                )
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Error: ${error}`
                    )
                })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                title: `${result.value.message}`,
                onClose: window.setTimeout(function() {
                    location.reload();
                }, 1500)
            })
        }
    })
};