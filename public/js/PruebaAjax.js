document.addEventListener("DOMContentLoaded", () => {
    const btnAjax = document.querySelector("#btnAjax");
    btnAjax.addEventListener("click", enviarPeticionAjax);

    function enviarPeticionAjax() {
        const objetoPrueba = {
            nombre: "Alan"
        };
        fetch("/pruebaAjax", {
            method: "POST",
            headers: {
                "Content-Type":"application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf_token"]').getAttribute("content")
            },
            body: JSON.stringify(objetoPrueba)
        }).then((response) => {
            return response.json();
        }).then((data) => {
            console.log(data);
        }).catch((error) => {
            console.log("Error en peticion AJAX");
            console.log(error.message);
        });
    }
});
