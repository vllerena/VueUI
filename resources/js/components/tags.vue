<template>
    <div>
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">Tags <Button @click="addModal=true" v-if="this.isWritePermitted"><Icon type="md-add" /> Add Tag</Button></h5>
            </div>
            <table class="table table-hover my-0">
                <thead>
                <tr>
                    <th class="d-none d-xl-table-cell">ID</th>
                    <th>Tag name</th>
                    <th class="d-none d-xl-table-cell">Created at</th>
                    <th class="d-xl-table-cell">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(tag, i) in tags" :key="i" v-if="tags.length">
                    <td class="d-none d-xl-table-cell">{{tag.id}}</td>
                    <td>{{tag.tagName}}</td>
                    <td class="d-none d-xl-table-cell">{{tag.created_at}}</td>
                    <td class="d-xl-table-cell">
                        <Button type="info" size="small" @click="showEditModal(tag, i)" v-if="isUpdatePermitted">Edit</Button>
                        <Button type="error" size="small" @click="showDeleteModal(tag, i)" :loading="tag.isDeleting" v-if="isDeletePermitted">Delete</Button>
                    </td>
                </tr>
                </tbody>
            </table>
            <Modal
                v-model="addModal"
                title="Add Tag"
                :mask-closable="false"
                :closable="false">
                <Input v-model="data.tagName" placeholder="Add tag name" />
                <div slot="footer">
                    <Button type="default" @click="addModal=false">Close</Button>
                    <Button type="primary" @click="addTag" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Adding..' : 'Add Tag'}}</Button>
                </div>
            </Modal>
            <Modal
                v-model="editModal"
                title="Edit Tag"
                :mask-closable="false"
                :closable="false">
                <Input v-model="editData.tagName" placeholder="Add tag name" />
                <div slot="footer">
                    <Button type="default" @click="editModal=false">Close</Button>
                    <Button type="primary" @click="editTag" :disabled="isEditing" :loading="isEditing">{{isEditing ? 'Editing..' : 'Edit Tag'}}</Button>
                </div>
            </Modal>
            <deleteModal></deleteModal>
        </div>
    </div>
</template>

<script>
import deleteModal from './deleteModal'
import { mapGetters } from 'vuex'
export default {
    name: "tags",
    components: {deleteModal},
    data(){
        return{
            data : {
                tagName: ''
            },
            editData: {
                tagName: ''
            },
            addModal: false,
            editModal: false,
            deleteModal: false,
            isAdding: false,
            isEditing: false,
            isDeleting: false,
            tags: [],
            index: -1,
            deleteItem: {},
            deletingIndex: -1,
        }
    },
    methods: {
        async addTag(){
            this.isAdding = true
            const res = await this.callApi('post', 'api/app/create_tag', this.data);
            if (res.status === 201){
                this.tags.unshift(res.data)
                this.success('Tag has been added successfully!')
                this.data.tagName = ''
            } else {
                if (res.status === 422){
                    if(res.data.errors.tagName){
                        this.info(res.data.errors.tagName[0])
                    }
                } else {
                    this.swr()
                }
            }
            this.isAdding = false
            this.addModal = false
        },
        async editTag(){
            this.isEditing = true
            const res = await this.callApi('post', 'api/app/edit_tag', this.editData);
            if (res.status === 200){
                this.tags[this.index].tagName = this.editData.tagName
                this.success('Tag has been edited successfully!')
            } else {
                if (res.status === 422){
                    if(res.data.errors.tagName){
                        this.info(res.data.errors.tagName[0])
                    }
                } else {
                    this.swr()
                }
            }
            this.isEditing = false
            this.editModal = false
        },
        async deleteTag(){
            this.isDeleting = true
            const res = await this.callApi('post', 'api/app/delete_tag', this.deleteItem);
            if(res.status === 200){
                this.tags.splice(this.deletingIndex, 1)
                this.success('Tag has been deleted successfully!')
            } else {
                this.swr()
            }
            this.isDeleting = false
            this.deleteModal = false
        },
        showEditModal(tag, index){
            let obj = {
                id: tag.id,
                tagName: tag.tagName
            }
            this.editData = obj
            this.editModal = true
            this.index = index
        },
        showDeleteModal(tag, index){
            const deleteModalObj = {
                showDeleteModal: true,
                deleteUrl: 'api/app/delete_tag',
                data: tag,
                deletingIndex: index,
                isDeleting: false,
                successMsg: "Tag eliminado",
                msg: "¿Deseas eliminar el tag?, esta acción no puede revertirse"
            }
            this.$store.commit('setDeletingModalObj', deleteModalObj)
        },
    },
    async created(){
        console.log(this.isUpdatePermitted)
        const res = await this.callApi('get', 'api/app/get_tag')
        if (res.status === 200){
            this.tags = res.data
            console.log(this.tags)
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
                this.tags.splice(obj.deletingIndex,1)
            }
        }
    }
}
</script>

<style scoped>

</style>
