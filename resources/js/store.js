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
        user: false
    },
    getters: {
        getDeleteModalObj(state){
            return state.deleteModalObj
        },
        getLoggedUser(state){
            return state.user
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
    },
    actions: {

    }
});
