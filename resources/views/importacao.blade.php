@extends('layouts')

@section('title', 'Home Page')

@section('content')
    <form @submit.prevent="novaImportacao">
        <h3>Importar funcionários</h3>
        <div class="mb-3">
            <label for="file" class="form-label">Arquivo</label>
            <input class="form-control" type="file" id="file" accept=".text,.csv,." @change="onFileChange" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    <br>
    <div class="col-12">
        <table class="table table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Arquivo</th>
                <th scope="col">Status</th>
                <th scope="col">Processado em</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="importacao in importacoes" :key="index">
                <th scope="row">@{{ importacao.id }}</th>
                <td>@{{ importacao.arquivo }}</td>
                <td>@{{ importacao.processado ? 'Processado' : 'Não processado' }}</td>
                <td>@{{ importacao.processado_em || '-' }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('vue-script')
    <script>
        new Vue({
            el: '#app',
            data: {
                importacoes: [],
                file: null,
            },
            mounted() {
                this.getImportacoes()
            },
            methods: {
                onFileChange(event) {
                    this.file = event.target.files[0];
                },
                getImportacoes() {
                    fetch(`/api/import`)
                        .then(response => response.json())
                        .then(response => {
                            this.importacoes = response;
                        })
                        .catch(error => {
                            console.error('Error fetching posts:', error);
                            this.loading = false;
                        });
                },
                novaImportacao() {
                    const formData = new FormData();
                    formData.append('file', this.file);

                    fetch('/api/import', {
                        method: 'POST',
                        body: formData
                    }).then(response => response.json())
                        .then(data => {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Funcionários importados com sucesso!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            this.getImportacoes();
                        })
                        .catch(error => {
                            console.error('Error fetching categories:', error);
                        });
                }
            }
        });
    </script>
@endsection
