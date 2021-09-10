<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                    <p class="_title0">Permission</p>
                    <Select v-model="data.id" placeholder="Select role" class="mb-2" @on-change="changeAdmin">
                        <Option :value="role.id" v-for="(role, i) in roles" :key="i" v-if="roles.length">{{role.roleName}}</Option>
                    </Select>
                    <div class="_overflow _table_div">
                        <table class="_table">
                            <tr>
                                <th>Route</th>
                                <th>Read</th>
                                <th>Write</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            <tr v-for="(resource, i) in resources" :key="i">
                                <td>{{resource.resourceName}}</td>
                                <td><Checkbox v-model="resource.read"></Checkbox></td>
                                <td><Checkbox v-model="resource.write"></Checkbox></td>
                                <td><Checkbox v-model="resource.update"></Checkbox></td>
                                <td><Checkbox v-model="resource.delete"></Checkbox></td>
                            </tr>
                            <div class="center_button">
                                <Button type="primary" :loading="isSending" :disabled="isSending" @click="assignRoles">Assign</Button>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "permission",
    data() {
        return {
            data: {
                id: null
            },
            resources: [
                {resourceName: 'Home', read: false, write: false, update: false, delete: false, name: '/'},
                {resourceName: 'Tags', read: false, write: false, update: false, delete: false, name: 'tags'},
                {resourceName: 'Admin users', read: false, write: false, update: false, delete: false, name: 'adminusers'},
                {resourceName: 'Role', read: false, write: false, update: false, delete: false, name: 'role'},
                {resourceName: 'Permission', read: false, write: false, update: false, delete: false, name: 'permission'},
            ],
            defaultResourcesPermission: [
                {resourceName: 'Home', read: false, write: false, update: false, delete: false, name: '/'},
                {resourceName: 'Tags', read: false, write: false, update: false, delete: false, name: 'tags'},
                {resourceName: 'Admin users', read: false, write: false, update: false, delete: false, name: 'adminusers'},
                {resourceName: 'Role', read: false, write: false, update: false, delete: false, name: 'role'},
                {resourceName: 'Permission', read: false, write: false, update: false, delete: false, name: 'permission'},
            ],
            isSending : false,
            roles: [],
        }
    },
    created(){
        this.getRoles()
    },
    methods: {
        async getRoles(){
            const res = await this.callApi('get', 'api/app/get_role')
            if (res.status === 200){
                this.roles = res.data
                if(res.data.length){
                    this.data.id = res.data[0].id
                    if(res.data[0].permission){
                        this.resources = JSON.parse(res.data[0].permission)
                        //this.resources = this.defaultResourcesPermission
                    }
                }
            } else {
                this.swr()
            }
        },
        async assignRoles(){
            let data = JSON.stringify(this.resources)
            const res = await this.callApi('post','api/app/assign_roles', {'permission' : data, id: this.data.id})
            if(res.status===200){
                this.success('Role has been assigned successfully!')
                let index = this.roles.findIndex(role => role.id === this.data.id)
                this.roles[index].permission = data
                // setTimeout(() => this.$router.go(), 400);
            }else{
                this.swr()
            }
        },
        changeAdmin(){
            let index = this.roles.findIndex(role => role.id === this.data.id)
            let permission = this.roles[index].permission
            if(!permission){
                this.resources = this.defaultResourcesPermission
            }else{
                this.resources = JSON.parse(permission)
            }
        }
    },
}
</script>

<style scoped>

</style>
