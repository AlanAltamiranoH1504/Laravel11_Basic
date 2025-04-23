document.addEventListener("DOMContentLoaded", () => {
    listarPostsPeticion();
    listarCategoriasPeticion();

    //Funciones
    function listarPostsPeticion() {
        fetch("/listPosts", {
            method: "GET"
        }).then((response) => {
            return response.json();
        }).then((data) => {
            listadoPostRenderizado(data);
        }).catch((error) => {
            console.log("Error en peticion al backend");
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
        categorias.forEach((categoria) => {
           const optionCategoria = document.createElement("option");
           optionCategoria.setAttribute("value", categoria.id);
           optionCategoria.innerHTML =  categoria.nombre;
           categoriasSelect.appendChild(optionCategoria);
        });
    }
});
