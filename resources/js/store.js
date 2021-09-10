import Vue from "vue";
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        deleteModalObj : {
            showDeleteModal: false,
            deleteUrl : '',
            data : null,
            deletingIndex: -1,
            isDeleted : false,
        },
        user: false,
        permissions: null
    },
    getters: {
        getDeleteModalObj(state){
            return state.deleteModalObj
        },
        getUser(state){
            return state.user
        },
        getUserPermission(state){
            return state.permissions
        },
    },
    mutations: {
        setDeleteModal(state, data){
            state.deleteModalObj = {
                showDeleteModal: false,
                deleteUrl: '',
                data: null,
                deletingIndex: -1,
                isDeleted: data,
            }
        },
        setDeletingModalObj(state, data){
            state.deleteModalObj = data
        },
        updateUser(state, data){
            state.user = data
        },
        updateUserPermission(state, data){
            state.permissions = data
        },
    },
    actions: {

    }
});
