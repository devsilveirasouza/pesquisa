
    // Deletar: Ajax & Sweetalert2
    $(document).on("click", ".delete_user", function (e) {
        e.preventDefault();
        //alert('Ola!');
        var user_id = $(this).val();
        //console.log(user_id);
        Swal.fire({
            title: "Você quer excluir?",
            text: "Não será mais possível usar este registro!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, Excluir!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });
                $.ajax({
                    type: "DELETE",
                    url: "/usuarios-delete/" + user_id,
                });
                setInterval("location.reload()", 1500);
                Swal.fire(
                    "Excluído!",
                    "O registro foi excluído com sucesso!",
                    "success"
                );
            }
        });
        //Editar: Ajax & Sweetalert2
        $('body').on('click', '.edit_user', function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Botão Edit foi clicado!',
                showConfirmButton: false,
                timer: 1500
            })
        });
    });

