document.addEventListener("DOMContentLoaded", () => {
    listarPostsPeticion();
    listarCategoriasPeticion();

    //Selectores
    const btnSendForm = document.querySelector("#sendForm");

    //Eventos
    btnSendForm.addEventListener("click", guardarPostPeticion);

    //Funciones
    function listarPostsPeticion() {
        fetch("/listPosts", {
            method: "GET"
        }).then((response) => {
            return response.json();
        }).then((data) => {
            listadoPostRenderizado(data);
        }).catch((error) => {
            console.log("Error en peticion al backend para listado de posts");
            console.log(error.message);
        });
    }

    function listarCategoriasPeticion() {
        fetch("/listCategorias", {
            method: "GET"
        }).then((response) => {
            return response.json();
        }).then((data) => {
            llenadoSelectCategorias(data);
        }).catch((error) => {
            console.log("Error en peticion al backend");
            console.log(error.message);
        })
    }

    function listadoPostRenderizado(postArray) {
        const bodyPosts = document.querySelector("#bodyPosts");
        bodyPosts.innerHTML = "";
        postArray.forEach((post) => {
            const trPost = document.createElement("tr");
            trPost.innerHTML = `
                <td>${post.id}</td>
                <td>${post.titulo}</td>
                <td>${post.slug}</td>
                <td>${post.descripcion}</td>
                <td>${post.contenido}</td>
                <td>${post.imagen}</td>
                <td>${post.publicado}</td>
                <td>${post.categoria.nombre}</td>
            `;
            bodyPosts.appendChild(trPost);
        })
    }

    function llenadoSelectCategorias(categorias) {
        const categoriasSelect = document.querySelector("#categoriasSelect");
        categoriasSelect.innerHTML = "";
        categorias.forEach((categoria) => {
           const optionCategoria = document.createElement("option");
           optionCategoria.setAttribute("value", categoria.id);
           optionCategoria.innerHTML =  categoria.nombre;
           categoriasSelect.appendChild(optionCategoria);
        });
    }

    function guardarPostPeticion(e) {
        e.preventDefault();

        const csrfToken = document.querySelector("#_token").value;
        const inputTitulo = document.querySelector("#titulo").value;
        const inputSlug = document.querySelector("#slug").value;
        const inputDescripcion = document.querySelector("#descripcion").value;
        const inputContenido = document.querySelector("#contenido").value;
        const selectPublicados = document.querySelector("#publicados").value;
        const selectCategorias = document.querySelector("#categoriasSelect").value;

        const postBody = {
            titulo: inputTitulo,
            slug: inputSlug,
            descripcion: inputDescripcion,
            contenido: inputContenido,
            publicado: selectPublicados,
            categoria_id: selectCategorias
        };

        fetch("/posts", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify(postBody)
        }).then((response) => {
            return response.json();
        }).then((data) => {
            if (!data.errors) {
                alertas("create", "success", "Post creado correctamente!", null);
                listarPostsPeticion();
                listarCategoriasPeticion();
            } else{
                alertas("create", "error", "Error en creacion de post", data.errors);
            }
        }).catch((error) => {
            console.log("Error en la peticion al backend");
            console.log(error.message);
        });
    }

    function alertas(lugar, tipo, msg, errores) {
        if (lugar === "create") {
            const divAlertasCreacion = document.querySelector("#alertasCreacion");
            if (tipo === "error") {
                const valuesErrores = Object.values(errores);
                valuesErrores.forEach((error) => {
                    const msgError = error[0];
                    const divError = document.createElement("div");
                    divError.classList.add("bg-danger", "mb-3", "text-white", "fw-semibold", "text-center", "rounded", "px-3", "py-1", "fs-5");
                    divError.textContent = msgError;
                    divAlertasCreacion.appendChild(divError);
                });
                setTimeout(() => {
                    divAlertasCreacion.innerHTML = "";
                }, 3500)
            } else {
                const divSucces = document.createElement("div");
                divSucces.classList.add("bg-success", "mb-3", "text-white", "fw-semibold", "text-center", "rounded", "px-3", "py-1", "fs-5");
                divSucces.textContent = msg;
                divAlertasCreacion.appendChild(divSucces);
                setTimeout(() => {
                    divAlertasCreacion.innerHTML = "";
                }, 3500)
            }
        }
    }
});
