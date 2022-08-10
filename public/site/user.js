// Cadastrar Usuário: Sweetalert2 para confirmação
$(".form_create_user").submit(function (e) {
    e.preventDefault();

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, saved it!",
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
            Swal.fire("Saved!", "Your file has been saved.", "success");
        }
    });
});
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
            /** Maneiras de recirecionar páginas */
            //window.location.assign("/usuarios");
            //window.location.replace("/usuarios");
            //window.location.href = "/usuarios";
            //setInterval("location.reload()", 1500);
            Swal.fire(
                "Excluído!",
                "O registro foi excluído com sucesso!",
                "success"
            );
        }
    });
});
//Editar: Ajax & Sweetalert2
$("body").on("click", ".edit_user", function (e) {
    e.preventDefault();

    var user_id = $(this).val();
    console.log(user_id);
    var url = "/usuarios/edit/";
    var rota = url + user_id;
    var user_id = $("#edit_user_id").val();

    //console.log(rota);+
    window.location.href = rota;
});
// Confirma o envio dos dados para atualização
$(".form_edit_user").submit(function (editar) {
    editar.preventDefault();

    Swal.fire({
        title: "Você têm certeza?",
        text: "Quer atualizar este registro?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, Atualizar!",
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
            Swal.fire("Atualizar!", "O registro foi atualizado.", "success");
        }
    });
});

//Editar: Ajax & Sweetalert2
$("body").on("click", ".details_user", function (e) {
    e.preventDefault();

    var user_id = $(this).val();
    // console.log(user_id);
    var url = "/usuarios/";
    var rota = url + user_id;

    // console.log(rota);
    window.location.href = rota;
});

$("body").on("click", ".home_user", function (e) {
    e.preventDefault();

    var rota = "/usuarios/";

    // console.log("Ola");
    window.location.href = rota;
});


