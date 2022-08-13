// Deletar: Ajax & Sweetalert2
$(document).on("click", ".delete_pergunta", function (e) {
    e.preventDefault();
    // alert('Ola!');
    var perguntaId = $(this).val();
    //alert(perguntaId);

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
                url: "/perguntas-delete/" + perguntaId,
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
// Cadastrar Usuário: Sweetalert2 para confirmação
$(".form_create_pergunta").submit(function (e) {
    e.preventDefault();

    Swal.fire({
        title: "Você têm certeza ?",
        text: "Quer salvar este registro!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, Salvar!",
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();

            Swal.fire("Salvo!", "O registro foi Salvo.", "success");

        }
    });

});
//Editar: Ajax & Sweetalert2
$("body").on("click", ".edit_pergunta", function (e) {
    e.preventDefault();
    //alert('Você clicou no botão edit!');

    var user_id = $(this).val();
    //console.log(user_id);
    var url = "/perguntas/edit/";
    var rota = url + user_id;
    // var user_id = $("#edit_pergunta_id").val();

    //console.log(rota);
    window.location.href = rota;
});
// // Confirma o envio dos dados para atualização
$(".form_pergunta_edit").submit(function (e) {
    e.preventDefault();

    Swal.fire({
        title: "Você têm certeza?",
        text: "Quer atualizar este registro?",
        icon: "question",
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
$("body").on("click", ".details_pergunta", function (e) {
    e.preventDefault();

    var pergunta_id = $(this).val();
    // console.log(user_id);
    var url = "/pergunta/";
    var rota = url + pergunta_id;

    // console.log(rota);
    window.location.href = rota;
});

$("body").on("click", ".home_user", function (e) {
    e.preventDefault();

    var rota = "/usuarios/";

    // console.log("Ola");
    window.location.href = rota;
});


