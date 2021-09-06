<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Listagem</div>

                    <div class="card-body">
                        <div class="alert alert-warning">
                            <h2>Cadastros</h2>
                            <ul>
                                <li v-for="(field,key,index) in success" style="">
                                    Nome: {{field.nome}}<br/>
                                    Email: {{field.email}}<br/> 
                                    Telefone: {{field.telefone}}<br/>
                                    Mensagem: {{field.mensagem}} <br/>
                                    Criado em: {{ field.created_at | moment("D/M/Y - H:s") }} <br/>
                                    <a @click="onClick(field.filePath)" class="btn btn-success">Baixar Documento</a>

                                </li>
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
                success: [],
            };
        },
        mounted:function(){
            let existingObj = this;
            axios.get('/listar')
                    .then(function (res) {
                        existingObj.success = res.data;
                        console.log('res',existingObj.success);
                    })
                    .catch(function (err, res) {
                        // Error
                        if (err.response) {
                            existingObj.output = err.response.data.errors;
                            // The request was made and the server responded with a status code
                            // that falls out of the range of 2xx
                            console.log(err.response.data.errors);
                            // console.log(error.response.status);
                            // console.log(error.response.headers);
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


                        // existingObj.output = err;
                       // this.error = existingObj.output;
                        console.log('error',err);
                    });
            
        },
        methods: {
            onClick(url) {
              axios({
                    url: url,
                    method: 'GET',
                    responseType: 'blob',
                }).then((response) => {
                     var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                     var fURL = document.createElement('a');
    
                     fURL.href = fileURL;
                     fURL.setAttribute('download', 'file.pdf');
                     document.body.appendChild(fURL);
    
                     fURL.click();
                });
          }

        }
    }

</script>