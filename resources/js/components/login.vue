<template>
    <div>
        <main class="d-flex w-100 bg-light">
            <div class="container d-flex flex-column">
                <div class="row vh-100">
                    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                        <div class="d-table-cell align-middle">
                            <div class="text-center my-4">
                                <h1 class="h2">Bienvenido(a)</h1>
                                <p class="lead">
                                    Por favor ingresa tus datos para iniciar el sistema.
                                </p>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="m-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input class="form-control form-control-lg" type="email" v-model="data.email" placeholder="Enter your email" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input class="form-control form-control-lg" type="password" v-model="data.password" placeholder="Enter your password" />
                                            </div>
                                            <div class="text-center mt-3">
                                                <button type="primary" @click="login" :disabled="isLogging" :loading="isLogging" class="btn btn-lg btn-primary">{{isLogging ? 'Loging...' : 'Login'}}</button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
<!--        <div class="container">-->
<!--            <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20 col-md-4">-->
<!--                <div class="login_header">-->
<!--                    <h1>Login Page</h1>-->
<!--                </div>-->
<!--                <Input type="email" v-model="data.email" class="mb-3" placeholder="Email" />-->
<!--                <Input type="password" v-model="data.password" class="mb-3" placeholder="Password" />-->
<!--                <div class="login_footer">-->
<!--                    <Button type="primary" @click="login" :disabled="isLogging" :loading="isLogging">{{isLogging ? 'Loging...' : 'Login'}}</Button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</template>

<script>
export default {
    name: "login",
    data(){
        return {
            data: {
                email: '',
                password: '',
            },
            isLogging: false
        }
    },
    methods: {
        async login(){
            if(this.data.email.trim()==='') return this.error('Email is required')
            if(this.data.password.trim()==='') return this.error('Password is required')
            if(this.data.password.length < 6) return this.error('Password is more than 6 characters')
            this.isLogging = true
            const res = await this.callApi('post', 'api/login', this.data)
            if(res.status === 200){
                this.success(res.data.message)
                window.location = '/'
            } else {
                if (res.status === 401){
                    this.error(res.data.message)
                } else if (res.status === 422) {
                    for (let i in res.data.errors){
                        this.error(res.data.errors[i])
                    }
                } else {
                    this.swr()
                }
            }
            this.isLogging = false
        }
    }
}
</script>

<style scoped>
._1adminOverveiw_table_recent{
    margin: 0 auto;
    margin-top: 220px;
}
.login_footer{
    margin: 0 auto;
    text-align: center;
}
.login_header{
    text-align: center;
    margin-bottom: 25px;
}
</style>

