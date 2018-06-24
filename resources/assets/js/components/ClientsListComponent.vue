<template>
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                Nuevo Cliente
            </button>
        </div>
        <div class="col-sm-4">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search" v-model="search">
                <span class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fa fa-search"></i>
                </button>
                </span>
            </div>
        </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ID/(USA)</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Fecha de nacimiento</th>
                <th scope="col">Sexo</th>
                <th scope="col">Dirección</th>
                <th scope="col">Edad</th>
                <th scope="col">Telefono (USA)</th>
                <th scope="col">Código postal (USA)</th>
                <th scope="col">Fecha de registro</th>
                <th scope="col" colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="!(filteredClients.length > 0)">
                <td class="text-center" colspan="12">
                    No exiten datos
                </td>
            </tr>
            <tr v-if="filteredClients.length > 0" v-for="client in filteredClients">
                <th scope="row">{{client.id}}</th>
                <td>{{client.passport}}</td>
                <td>{{client.name}}</td>
                <td>{{client.lastname}}</td>
                <td>{{client.birth_date}}</td>
                <td>{{client.sex}}</td>
                <td>{{client.address}}</td>
                <td>{{client.age}}</td>
                <td>{{client.phone}}</td>
                <td>{{client.postal_code}}</td>
                <td>{{client.created_at}}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" @click="editClient(client)">
                        <i class="fa fa-fw fa-wrench"></i>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" v-on:click.prevent="deleteClient(client.id)">
                        <i class="fa fa-fw fa-trash"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Nuevo Cliente</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="passport">ID (USA)/ Pasaporte</label>
                                <input v-if="!this.editing" type="text" class="form-control" id="passport" placeholder="Pasaporte" v-model="client.passport">
                                <input v-if="this.editing" type="text" class="form-control" id="passport" placeholder="Pasaporte" v-model="clientEdit.passport">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input v-if="!editing" type="text" class="form-control" id="name" placeholder="Nombre" v-model="client.name">
                                <input v-if="editing" type="text" class="form-control" id="name" placeholder="Nombre" v-model="clientEdit.name">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input v-if="!editing" type="text" class="form-control" id="apellido" placeholder="Apellido" v-model="client.lastname">
                                <input v-if="editing" type="text" class="form-control" id="apellido" placeholder="Apellido" v-model="clientEdit.lastname">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="birth_date">Fecha de nacimiento</label>
                                <input v-if="!editing" type="text" class="form-control datepicker date" id="birth_date" placeholder="dd/mm/YYYY" v-model.lazy="client.birth_date">
                                <input v-if="editing" type="text" class="form-control datepicker date" id="birth_date" placeholder="dd/mm/YYYY" v-model="clientEdit.birth_date">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="birth_date">Sexo</label>
                                <select class="form-control form-control-sm" v-if="!editing" v-model="client.sex">
                                    <option value="Femenino">Femenino</option>
                                    <option value="Masculino">Masculino</option>
                                </select>
                                <select class="form-control form-control-sm" v-if="editing" v-model="clientEdit.sex">
                                    <option value="Femenino">Femenino</option>
                                    <option value="Masculino">Masculino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="age">Edad</label>
                                <input v-if="!editing" type="text" class="form-control" id="age" placeholder="Edad" v-model="client.age">
                                <input v-if="editing" type="text" class="form-control" id="age" placeholder="Edad" v-model="clientEdit.age">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="phone">Telefono</label>
                                <input v-if="!editing" type="text" class="form-control phone" id="phone" placeholder="(000) 000-0000" v-model.lazy="client.phone">
                                <input v-if="editing" type="text" class="form-control" id="phone" placeholder="(000) 000-0000" v-model.lazy="clientEdit.phone">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="postal_code">Código postal</label>
                                <input v-if="!editing" type="text" class="form-control" id="postal_code" placeholder="Código postal" v-model="client.postal_code">
                                <input v-if="editing" type="text" class="form-control" id="postal_code" placeholder="Código postal" v-model="clientEdit.postal_code">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <textarea v-if="!editing" class="form-control" id="address" rows="3" v-model="client.address"></textarea>
                        <textarea v-if="editing" class="form-control" id="address" rows="3" v-model="clientEdit.address"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button v-if="!editing" type="button" class="btn btn-primary" @click="saveClient()">
                    Guardar
                </button>

                <button v-if="editing" type="button" class="btn btn-primary" @click="updateClient()">
                    Modificar
                </button>
            </div>
            </div>
        </div>
    </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('clients-list component')
        },
        data () {
            return {
                search: '',
                clients: [],
                editing: false,
                clientEdit: {},
                client: {
                    name:'',
                    lastname: '',
                    age:0,
                    passport:'',
                    birth_date:'',
                    phone:'',
                    postal_code:0,
                    sex:'Femenino',
                    address:''
                }
            }
        },
        created() {
            this.getClientList()
        },
        computed: {
            filteredClients() {
                return this.clients.filter(client => {
                    return client.name.toLowerCase().includes(this.search.toLowerCase())
                    || client.lastname.toLowerCase().includes(this.search.toLowerCase())
                    || client.passport.toLowerCase().includes(this.search.toLowerCase())
                    || client.birth_date.toLowerCase().includes(this.search.toLowerCase())
                    || client.sex.toLowerCase().includes(this.search.toLowerCase())
                    || client.address.toLowerCase().includes(this.search.toLowerCase())
                    || client.phone.toLowerCase().includes(this.search.toLowerCase())
                    || client.created_at.toLowerCase().includes(this.search.toLowerCase())
                    || client.age == parseInt(this.search.toLowerCase())
                    || client.postal_code == parseInt(this.search.toLowerCase())
                })
            }
        },
        methods: {
            getClientList () {
                axios.get('clients').then(response => {
                    this.clients = response.data
                })
            },
            saveClient () {
                axios.post('new_client', this.client).then(response => {
                    this.client = {
                        name:'',
                        lastname: '',
                        age:0,
                        passport:'',
                        birth_date:'',
                        phone:'',
                        postal_code:0,
                        sex:'',
                        address:''
                    }
                    this.getClientList()
                    swal("Cliente Guardado", "El cliente se ha guardado con exito", "success");
                    
                })
            },
            deleteClient (id) {
                swal({
                    title: "Información",
                    text: "¿Esta seguro que desea eliminar el cliente?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            axios.post('delete_client/'+id).then(response => {
                                swal("Cliente eliminado con exito!", {
                                    icon: "success",
                                });
                                this.getClientList()
                            }).catch(err => {
                                console.log(err)
                            })
                        }
                })
            },
            editClient (client) {
                this.editing =true;
                this.clientEdit = Object.assign({}, client)
                $('#modal').modal('show')
                $('#modal').on('hidden.bs.modal', e => {
                    this.editing =false
                    this.clientEdit = {}
                })
            },
            updateClient () {
                axios.post('edit_client/'+this.clientEdit.id, this.clientEdit).then(response => {
                    swal("Cliente actualizado con exito!", {
                        icon: "success",
                    })
                    this.getClientList()
                    $('#modal').modal('hide')
                }).catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>
