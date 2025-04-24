@extends("layout.master")

@section("content")
    <div class="container-xl">
        <div class="row d-flex justify-content-center">
            <div class="col-md-11">
                <div class="d-flex flex-column flex-md-row gap-3">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#nuevoPost"
                            class="btn btn-primary w-100 fw-semibold">
                        <i class="bi bi-plus-circle me-2"></i> Agregar Post
                    </button>

                    <button type="button" data-bs-toggle="modal" data-bs-target="#nuevaCategoria"
                            class="btn btn-primary w-100 fw-semibold">
                        <i class="bi bi-plus-circle me-2"></i>Agregar Categoria
                    </button>
                </div>
                <div id="delete" class="mt-4"></div>
                <input type="hidden" id="tokePrueba" value="{{csrf_token()}}">

                <div class="table-responsive">
                    <table class="table table-hover shadow-sm mt-4 rounded overflow-hidden text-center align-middle">
                        <thead class="table-dark text-uppercase">
                        <tr>
                            <th>ID</th>
                            <th>Titulo</th>
                            <th>Slug</th>
                            <th>Descripcion</th>
                            <th>Contenido</th>
                            <th>Imagen</th>
                            <th>Publicado (Estado)</th>
                            <th>Categoria</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody id="bodyPosts">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{--Modal crear post--}}
        <div class="modal fade" id="nuevoPost" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header">
                        <h4 class="modal-title fw-bold text-uppercase text-center">Agregar Post</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="w-100 mt-2" id="alertasCreacion"></div>
                        <form class="d-flex flex-column gap-3" enctype="multipart/form-data">
                            <input type="hidden" id="_token" value="{{csrf_token()}}">
                            <div>
                                <label for="titulo" class="form-label fw-semibold">Titulo</label>
                                <input type="text" class="form-control" id="titulo" placeholder="Titulo del producto">
                            </div>
                            <div>
                                <label for="slug" class="form-label fw-semibold">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug"
                                       placeholder="Slug del post">
                            </div>
                            <div>
                                <label for="descripcion" class="form-label fw-semibold">Descripción</label>
                                <input type="text" class="form-control" id="descripcion"
                                       placeholder="Descripción del post">
                            </div>
                            <div>
                                <label for="contenido" class="form-label fw-semibold">Contenudo</label>
                                <input type="text" class="form-control" id="contenido" placeholder="Contenido del post">
                            </div>
                            <div>
                                <label for="imagen" class="form-label fw-semibold">Imagen</label>
                                <input type="file" name="imagen" class="form-control" id="imagen"
                                       placeholder="Imagen del post">
                            </div>
                            <div>
                                <label for="publicados" class="form-label fw-semibold">¿Publicado?</label>
                                <select id="publicados" name="publicados" class="form-control">
                                    <option value="">--- Selecciona una Estado ---</option>
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div>
                                <label for="categorias" class="form-label fw-semibold">Categoria</label>
                                <select id="categoriasSelect" name="categorias" class="form-control">
                                    <option value="">--- Selecciona una Categoria ---</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" id="sendForm" class="btn btn-success fw-semibold">Agregar</button>
                        <button type="button" class="btn btn-outline-danger fw-semibold" data-bs-dismiss="modal">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{--Modal edicion--}}
        <div class="modal fade" id="editarPost" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header">
                        <h4 class="modal-title fw-bold text-uppercase text-center">Editar Post</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="w-100 mt-2" id="alertasCreacion"></div>
                        <form class="d-flex flex-column gap-3" enctype="multipart/form-data">
                            <input type="hidden" id="_token" value="{{csrf_token()}}">
                            <div>
                                <label for="titulo" class="form-label fw-semibold">Titulo</label>
                                <input type="text" class="form-control" id="tituloEdicion" placeholder="Titulo del producto">
                            </div>
                            <div>
                                <label for="slug" class="form-label fw-semibold">Slug</label>
                                <input type="text" class="form-control" id="slugEdicion" name="slug" placeholder="Slug del post">
                            </div>
                            <div>
                                <label for="descripcion" class="form-label fw-semibold">Descripción</label>
                                <input type="text" class="form-control" id="descripcionEdicion" placeholder="Descripción del post">
                            </div>
                            <div>
                                <label for="contenido" class="form-label fw-semibold">Contenudo</label>
                                <input type="text" class="form-control" id="contenidoEdicion" placeholder="Contenido del post">
                            </div>
                            <div>
                                <label for="imagen" class="form-label fw-semibold">Imagen</label>
                                <input type="file" name="imagen" class="form-control" id="imagenEdicion" placeholder="Imagen del post">
                            </div>
                            <div>
                                <label for="publicados" class="form-label fw-semibold">¿Publicado?</label>
                                <select id="publicadosEdicion" name="publicados" class="form-control">
                                    <option value="">--- Selecciona una Estado ---</option>
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div>
                                <label for="categorias" class="form-label fw-semibold">Categoria</label>
                                <select id="categoriasSelectEdicion" name="categorias" class="form-control">
                                    <option value="">--- Selecciona una Categoria ---</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" id="sendForm" class="btn btn-success fw-semibold">Actualizar</button>
                        <button type="button" class="btn btn-outline-danger fw-semibold" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
