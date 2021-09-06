<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registrar</div>

                    <div class="card-body">

                        <form @submit="formSubmit" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input id="nome" class="form-control"  type="text" v-model="nome">
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input id="email" class="form-control" type="email" v-model="email">
                            </div>

                            <div class="form-group">
                                <label for="telefone">Telefone:</label>
                                <input id="telefone" class="form-control" type="text" v-model="telefone">
                            </div>

                            <div class="form-group">
                                <label for="mensagem">Mensagem:</label>
                                <textarea id="mensagem" class="form-control" v-model="mensagem"></textarea>
                            </div>

                            <input type="file" class="form-control" v-on:change="onChange">
                            <br/>
                            <br/>
                            <button class="btn btn-primary btn-block">Registrar</button>
                        </form>
                        <br/>
                         <div v-if="success != ''" class="alert alert-success">
                            {{success}}
                        </div>
                        <div v-if="output != ''" class="alert alert-warning">
                            <h2>Campos requeridos</h2>
                            <ul>
                                <li v-for="(field,key,index) in output">{{key}}: {{field[0]}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                nome: '',
                email: '',
                telefone: '',
                mensagem: '',
                file: '',
                success: '',
                output: '',
                error: [],
            };
        },
        methods: {
            onChange(e) {
                this.file = e.target.files[0];
            },
            formSubmit(e) {
                e.preventDefault();
                let existingObj = this;

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                var data = new FormData();
                data.append('file', this.file);
                data.append('telefone', this.telefone);
                data.append('email', this.email);
                data.append('mensagem', this.mensagem);
                data.append('nome', this.nome);
                
                axios.post('/registrar', data, config)
                    .then(function (res) {
                        existingObj.success = res.data.success;
                        console.log('res',res);
                    })
                 
                    .catch(function (err, res) {
                        // Error
                        if (err.response) {
                            existingObj.output = err.response.data.errors;
                           
                            console.log(err.response.data.errors);
              
                        } else if (err.request) {
                            // The request was made but no response was received
                            // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                            // http.ClientRequest in node.js
                            console.log(err.request);
                        } else {
                            // Something happened in setting up the request that triggered an Error
                            console.log('Error', err.message);
                        }
                        console.log(err.config);

                        console.log('error',err);
                    });
            }
        }
    }

</script>