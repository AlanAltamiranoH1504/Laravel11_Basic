document.addEventListener("DOMContentLoaded", () => {
    listarPostsPeticion();
    listarCategoriasPeticion("creacion");

    //Selectores
    const btnSendForm = document.querySelector("#sendForm");
    const btnsendFormUpdate = document.querySelector("#sendFormUpdate");

    //Eventos
    btnSendForm.addEventListener("click", guardarPostPeticion);
    btnsendFormUpdate.addEventListener("click", actualizarPostPeticion);

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

    function listarCategoriasPeticion(lugar) {
        fetch("/listCategorias", {
            method: "GET"
        }).then((response) => {
            return response.json();
        }).then((data) => {
            llenadoSelectCategorias(data, lugar);
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
                <td>
                    <div class="d-flex justify-content-center align-items-center gap-3">
                        <button type="button" class="btn btn-warning" id="btnEdicion" data-id="${post.id}">
                            Editar
                        </button>
                        <button type="button" class="btn btn-danger" id="btnEliminar" data-id="${post.id}">
                            Eliminar
                        </button>
                    </div>
                </td>
            `;
            bodyPosts.appendChild(trPost);
        });
        bodyPosts.addEventListener("click", (e) => {
            const accionBtnSeleccionado = e.target.getAttribute("id");
            if (accionBtnSeleccionado === "btnEliminar") {
                eliminiarPostPeticion(e.target.getAttribute("data-id"));
            } else {
                editarPostPeticion(e.target.getAttribute("data-id"));
            }
        })
    }

    function llenadoSelectCategorias(categorias, lugar) {
        if (lugar === "creacion") {
            const categoriasSelect = document.querySelector("#categoriasSelect");
            categoriasSelect.innerHTML = "";
            categorias.forEach((categoria) => {
                const optionCategoria = document.createElement("option");
                optionCategoria.setAttribute("value", categoria.id);
                optionCategoria.innerHTML = categoria.nombre;
                categoriasSelect.appendChild(optionCategoria);
            });
        } else {
            const categoriasSelectEdicion = document.querySelector("#categoriasSelectEdicion");
            categoriasSelectEdicion.innerHTML = "";
            categorias.forEach((categoria) => {
                const optionCategoria = document.createElement("option");
                optionCategoria.setAttribute("value", categoria.id);
                optionCategoria.innerHTML = categoria.nombre;
                categoriasSelectEdicion.appendChild(optionCategoria);
            });
        }


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
            } else {
                alertas("create", "error", "Error en creacion de post", data.errors);
            }
        }).catch((error) => {
            console.log("Error en la peticion al backend");
            console.log(error.message);
        });
    }

    function eliminiarPostPeticion(id) {
        if (confirm("¿Estás seguro que quieres eliminar el post?")) {
            const bodyPost = {
                id
            };
            const csrfToken = document.querySelector("#_token").value;

            fetch(`/posts/${id}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify(bodyPost)
            }).then((response) => {
                return response.json();
            }).then((data) => {
                alertas("delete", "sucess", data.message, null);
                listarPostsPeticion();
            }).catch((error) => {
                console.log("Error en peticion para eliminacion");
                console.log(error.message);
            });
        }
    }

    function editarPostPeticion(id) {
        const bodyPost = {
            id
        };
        const token = document.querySelector("#_token").value;

        fetch(`/posts/${id}`, {
            method: "GET",
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token
            }
        }).then((response) => {
            return response.json();
        }).then((data) => {
            if (!data.post) {
                console.log("Muestra alertas de post no encontrado");
            } else {
                listarCategoriasPeticion("edicion");
                llenarFormularioActualizacion(data.post);
            }
        }).catch((error) => {
            console.log("Error en peticion");
            console.log(error.message);
        })
    }

    function llenarFormularioActualizacion(post) {
        const modalEdicion = new bootstrap.Modal(document.querySelector("#editarPost"));
        modalEdicion.show();

        document.querySelector("#idPost").value = post.id;
        document.querySelector("#tituloEdicion").value = post.titulo;
        document.querySelector("#slugEdicion").value = post.slug;
        document.querySelector("#descripcionEdicion").value = post.descripcion;
        document.querySelector("#contenidoEdicion").value = post.contenido;
        document.querySelector("#publicadosEdicion").value = post.publicado;
    }

    function actualizarPostPeticion() {
        const inputId = document.querySelector("#idPost").value;
        const csrfToken = document.querySelector("#_tokenUpdate").value;
        const inputTitulo = document.querySelector("#tituloEdicion").value;
        const inputSlug = document.querySelector("#slugEdicion").value;
        const inputDescripcion = document.querySelector("#descripcionEdicion").value;
        const inputContenido = document.querySelector("#contenidoEdicion").value;
        const inputPublicado = document.querySelector("#publicadosEdicion").value;
        const inputCategoria = document.querySelector("#categoriasSelectEdicion").value;

        const boydPostUpdate = {
            id: inputId,
            titulo: inputTitulo,
            slug: inputSlug,
            descripcion: inputDescripcion,
            contenido: inputContenido,
            publicado: inputPublicado,
            categoria_id: inputCategoria,
        };

        fetch(`/posts/update`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify(boydPostUpdate)
        }).then((response) => {
            return response.json();
        }).then((data) => {
            if (data.message) {
                alertas("update", "success", data.message, null);
                listarPostsPeticion();
            } else{
                alertas("update", "error", data.message, null);
            }
        }).catch((error) => {
            console.log("Error en peticion");
            console.log(error.message);
        });
    }

    function alertas(lugar, tipo, msg, errores) {
        if (lugar === "create") {
            const divAlertasCreacion = document.querySelector("#alertasCreacion");
            divAlertasCreacion.innerHTML = "";
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
        } else if (lugar === "delete") {
            const divAlertasEliminacion = document.querySelector("#delete");
            divAlertasEliminacion.innerHTML = "";
            if (tipo === "error") {
                const divError = document.createElement("div");
                divError.classList.add("bg-danger", "mb-3", "text-white", "fw-semibold", "text-center", "rounded", "px-3", "py-1", "fs-5");
                divError.textContent = msg;
                divAlertasEliminacion.appendChild(divError);
                setTimeout(() => {
                    divAlertasEliminacion.innerHTML = "";
                }, 3500);
            } else {
                const divSucces = document.createElement("div");
                divSucces.classList.add("bg-success", "mb-3", "text-white", "fw-semibold", "text-center", "rounded", "px-3", "py-1", "fs-5");
                divSucces.textContent = msg;
                divAlertasEliminacion.appendChild(divSucces);
                setTimeout(() => {
                    divAlertasEliminacion.innerHTML = "";
                }, 3500);
            }
        } else if (lugar === "update") {
            const divAlertasActualizacion = document.querySelector("#alertasActualizacion");
            divAlertasActualizacion.innerHTML = "";
            if (tipo === "error") {
                const divError = document.createElement("div");
                divError.classList.add("bg-danger", "mb-3", "text-white", "fw-semibold", "text-center", "rounded", "px-3", "py-1", "fs-5");
                divError.textContent = msg;
                divAlertasActualizacion.appendChild(divError);
                setTimeout(() => {
                    divAlertasActualizacion.innerHTML = "";
                }, 3500);
            } else {
                const divSucces = document.createElement("div");
                divSucces.classList.add("bg-success", "mb-3", "text-white", "fw-semibold", "text-center", "rounded", "px-3", "py-1", "fs-5");
                divSucces.textContent = msg;
                divAlertasActualizacion.appendChild(divSucces);
                setTimeout(() => {
                    divAlertasActualizacion.innerHTML = "";
                }, 3500);
            }
        }
    }
});
