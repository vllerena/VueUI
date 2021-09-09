<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                    <p class="_title0">Roles <Button @click="addModal=true"><Icon type="md-add" /> Add Role</Button></p>
                    <div class="_overflow _table_div">
                        <table class="_table">
                            <tr>
                                <th>ID</th>
                                <th>Role name</th>
                                <th>Created at</th>
                            </tr>
                            <tr v-for="(role, i) in roles" :key="i" v-if="roles.length">
                                <td>{{role.id}}</td>
                                <td class="_table_name">{{role.roleName}}</td>
                                <td>{{role.created_at}}</td>
                            </tr>
                        </table>
                    </div>
                    <Modal
                        v-model="addModal"
                        title="Add Role"
                        :mask-closable="false"
                        :closable="false">
                        <Input v-model="data.roleName" placeholder="Add role name" />
                        <i-switch v-model="data.isAdmin" @on-change="change" size="large" class="mt-2">
                            <span slot="open">Admin</span>
                            <span slot="close">User</span>
                        </i-switch>
                        <div slot="footer">
                            <Button type="default" @click="addModal=false">Close</Button>
                            <Button type="primary" @click="addRole" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding..' : 'Add Role'}}</Button>
                        </div>
                    </Modal>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import deleteModal from './deleteModal'
import { mapGetters } from 'vuex'
export default {
    name: "role",
    data(){
        return{
            data : {
                roleName: '',
                isAdmin: false
            },
            editData: {
                roleName: ''
            },
            addModal: false,
            editModal: false,
            deleteModal: false,
            isAdding: false,
            isEditing: false,
            isDeleting: false,
            roles: [],
            index: -1,
            deleteItem: {},
            deletingIndex: -1,
        }
    },
    methods: {
        async addRole(){
            this.isAdding = true
            const res = await this.callApi('post', 'api/app/create_role', this.data);
            if (res.status === 201){
                this.roles.unshift(res.data)
                this.success('Role has been added successfully!')
                this.data.roleName = ''
            } else {
                if (res.status === 422){
                    if(res.data.errors.roleName){
                        this.info(res.data.errors.roleName[0])
                    }
                } else {
                    this.swr()
                }
            }
            this.isAdding = false
            this.addModal = false
        },
        async editRole(){
            this.isEditing = true
            const res = await this.callApi('post', 'api/app/edit_role', this.editData);
            if (res.status === 200){
                this.roles[this.index].roleName = this.editData.roleName
                this.success('Role has been edited successfully!')
            } else {
                if (res.status === 422){
                    if(res.data.errors.roleName){
                        this.info(res.data.errors.roleName[0])
                    }
                } else {
                    this.swr()
                }
            }
            this.isEditing = false
            this.editModal = false
        },
        async deleteRole(){
            this.isDeleting = true
            const res = await this.callApi('post', 'api/app/delete_role', this.deleteItem);
            if(res.status === 200){
                this.roles.splice(this.deletingIndex, 1)
                this.success('Role has been deleted successfully!')
            } else {
                this.swr()
            }
            this.isDeleting = false
            this.deleteModal = false
        },
        showEditModal(rol, index){
            let obj = {
                id: rol.id,
                roleName: rol.roleName
            }
            this.editData = obj
            this.editModal = true
            this.index = index
        },
        showDeleteModal(rol, index){
            const deleteModalObj = {
                showDeleteModal: true,
                deleteUrl: 'api/app/delete_role',
                data: rol,
                deletingIndex: index,
                isDeleting: false,
                successMsg: "Rol eliminado",
                msg: "¿Deseas eliminar el rol?, esta acción no puede revertirse"
            }
            this.$store.commit('setDeletingModalObj', deleteModalObj)
        },
        change (status) {
            this.data.isAdmin = status;
        }
    },
    async created(){
        const res = await this.callApi('get', 'api/app/get_role')
        if (res.status === 200){
            this.roles = res.data
            console.log(this.roles)
        } else {
            this.swr()
        }
    },
    computed : {
        ...mapGetters(['getDeleteModalObj'])
    },
    watch : {
        getDeleteModalObj(obj){
            if(obj.isDeleted){
                this.roles.splice(obj.deletingIndex,1)
            }
        }
    }
}
</script>

<style scoped>

</style>
