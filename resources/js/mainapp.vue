<template>
    <div>
        <nav v-if="$store.state.user" class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
            <div class="navbar-container d-flex content">
                <div class="bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav d-xl-none">
                        <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons">
                        <li class="nav-item d-none d-lg-block"><router-link class="nav-link" to="home" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Email"><i class="ficon" data-feather="mail"></i></router-link></li>
                        <li class="nav-item d-none d-lg-block"><router-link class="nav-link" to="tags" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chat"><i class="ficon" data-feather="message-square"></i></router-link></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav align-items-center ms-auto">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
                    <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">John Doe</span><span class="user-status">Admin</span></div><span class="avatar"><img class="round" src="https://ui-avatars.com/api/?name=John+Doe" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                            <router-link class="dropdown-item" to="logout"><i class="me-50" data-feather="power"></i> Logout</router-link>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div v-if="$store.state.user" class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item me-auto">
                        <router-link class="navbar-brand" to="/">
                            <span class="brand-logo"></span>
                        <h2 class="brand-text">Vuexy</h2>
                    </router-link></li>
                    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
                </ul>
            </div>
            <div class="shadow-bottom"></div>
            <div class="main-menu-content">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class="navigation-header">
                        <span>Administración</span><i data-feather="more-horizontal"></i>
                    </li>
                    <li class="nav-item" v-for="(menuItem, i) in permission" :key="i" v-if="permission.length && menuItem.read">
                        <router-link class="d-flex align-items-center" :to="menuItem.name"><i data-feather="user"></i> <span class="menu-title text-truncate"> {{menuItem.resourceName}}</span></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="d-flex align-items-center" to="logout"><i data-feather="log-in"></i> <span class="menu-title text-truncate">Logout</span></router-link>
                    </li>
                </ul>
            </div>
        </div>
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-body">
                    <router-view/>
                </div>
            </div>
        </div>
        <div v-if="$store.state.user" class="sidenav-overlay"></div>
        <div v-if="$store.state.user" class="drag-target"></div>
        <footer v-if="$store.state.user" class="footer footer-static footer-light">
            <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ms-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
        </footer>
        <button v-if="$store.state.user" class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
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
/*.router-link-exact-active{*/
/*    color: #6bc6ff !important;*/
/*    border-right: 2px solid #6bc6ff !important;*/
/*    background: #0c3572;*/
/*}*/
/*.router-link-active{*/

/*}*/
</style>
