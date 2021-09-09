<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <div class="demo-spin-container">
                    <Spin fix></Spin>
                </div>
            </div>
         </div>
    </div>
</template>

<script>
export default {
    name: "logout",
    created() {
        this.logout()
    },
    methods: {
        async logout(){
            const res = await this.callApi('post', 'api/logout')
            if(res.status === 200){
                this.success(res.data.msg)
                window.location = '/'
            } else {
                if (res.status === 401){
                    this.error(res.data.msg)
                } else {
                    this.swr()
                }
            }
        }
    }
}
</script>

<style scoped>
.demo-spin-container{
    display: inline-block;
    width: 100%;
    height: 100px;
    position: relative;
    border: 1px solid #eee;
}
</style>
