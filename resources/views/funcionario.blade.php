@extends('layouts')

@section('title', 'Home Page')

@section('content')
    <form @submit.prevent="escalaFuncionarios">
        <h3>Escala funcionários</h3>
        <div class="mb-3">
            <label for="ano" class="form-label">Ano</label>
            <input type="number" class="form-control" id="ano" v-model="ano" required>
        </div>
        <div class="mb-3">
            <label for="mes" class="form-label">Mês</label>
            <input type="number" class="form-control" id="mes" v-model="mes" required>
        </div>
        <div class="mb-3">
            <label for="filial" class="form-label">filial</label>
            <select class="form-select" id="filial" v-model="filial" v-model="filial">
                <option v-for="id in filiais" :key="id" :value="id">
                    @{{ id }}
                </option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    <br>
    <div class="col-12" v-if="funcionarios">
        <table class="table table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Filial</th>
                <th scope="col">Matrícula</th>
                <th scope="col">Nome</th>
                <th scope="col">Ultima folga</th>
                <th scope="col">Domingos</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="funcionario in funcionarios" :key="index">
                <th scope="row">@{{ funcionario.id }}</th>
                <td>@{{ funcionario.filial }}</td>
                <td>@{{ funcionario.matricula }}</td>
                <td>@{{ funcionario.nome }}</td>
                <td>@{{ formatDate(funcionario.ultima_folga) }}</td>
                <td>
                    <ul>
                        <li v-for="(value, date) in funcionario.domingos" :key="date">
                            @{{ date }}: @{{ value }}
                        </li>
                    </ul>
                </td>
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
                ano: null,
                mes: null,
                filial: null,
                filiais: [],
                funcionarios: []
            },
            mounted() {
                this.obterFiliais()
            },
            methods: {
                formatDate(date) {
                    return new Date(date).toLocaleDateString('pt-BR');
                },
                obterFiliais() {
                    fetch(`/api/funcionario/filial`)
                        .then(response => response.json())
                        .then(response => {
                            this.filiais = response;
                        })
                        .catch(error => {
                            console.error('Error fetching posts:', error);
                            this.loading = false;
                        });
                },
                escalaFuncionarios() {
                    const data = {
                        ano: this.ano,
                        mes: this.mes,
                        filial: this.filial
                    };

                    fetch('/api/funcionario', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    }).then(response => response.json())
                        .then(response => {
                            this.funcionarios = response
                        })
                        .catch(error => {
                            console.error('Error fetching categories:', error);
                        });
                }
            }
        });
    </script>
@endsection
