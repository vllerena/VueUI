<template>
    <div>
        <div class="wrapper">
            <nav v-if="$store.state.user" id="sidebar" class="sidebar js-sidebar">
                <div class="sidebar-content js-simplebar">
                    <a class="sidebar-brand" href="index.html">
                        <span class="align-middle">AdminKit</span>
                    </a>
                    <ul class="sidebar-nav">
                        <li class="sidebar-header">
                            Admin
                        </li>
                        <li class="sidebar-item" v-for="(menuItem, i) in permission" :key="i" v-if="permission.length && menuItem.read">
                            <router-link class="sidebar-link" :to="menuItem.name"><i class="align-middle" data-feather="user"></i> <span class="align-middle"> {{menuItem.resourceName}}</span></router-link>
                        </li>
                        <li class="sidebar-item">
                            <router-link class="sidebar-link" to="logout"><i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Logout</span></router-link>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="main">
                <nav v-if="$store.state.user" class="navbar navbar-expand navbar-light navbar-bg">
                    <a class="sidebar-toggle js-sidebar-toggle">
                        <i class="hamburger align-self-center"></i>
                    </a>
                    <div class="navbar-collapse collapse">
                        <ul class="navbar-nav navbar-align">
                            <li class="nav-item dropdown">
                                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                    <i class="align-middle" data-feather="settings"></i>
                                </a>
                                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                    <img src="https://ui-avatars.com/api/?name=John+Doe" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark">Charles Hall</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <router-link class="dropdown-item" to="logout"><i class="align-middle me-1" data-feather="log-in"></i> Log out</router-link>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <main class="content">
                    <router-view/>
                </main>
                <footer v-if="$store.state.user" class="footer">
                    <div class="container-fluid">
                        <div class="row text-muted">
                            <div class="col-6 text-start">
                                <p class="mb-0">
                                    <a class="text-muted" href="#" target="_blank"><strong>AdminKit Demo</strong></a> &copy;
                                </p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "mainapp",
    props: ['user', 'permission'],
    data(){
        return {

        }
    },
    created(){
        this.$store.commit('updateUser', this.user)
        this.$store.commit('updateUserPermission', this.permission)
    }
}
</script>

<style scoped>
.router-link-exact-active{
    color: #6bc6ff !important;
    border-right: 2px solid #6bc6ff !important;
    background: #0c3572;
}
.router-link-active{

}
</style>
