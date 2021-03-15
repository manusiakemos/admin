<template>
    <sidebar-menu :hide-toggle="true" theme="white-theme" width="250px" :menu="menu" class="shadow-lg">
        <div slot="header" class="mb-3 mt-3">
            <div class="d-flex flex-column align-items-center">
                <img :src="user.avatar ? '/images/'+user.avatar : '/images/avatar.png'" alt="logo" height="60" class="img pl-4 pr-4 rounded-circle">
                <h6 class="mt-3">{{user.name}}</h6>
            </div>
        </div>
        <div slot="footer">
            <b-btn class="p-3" variant="primary" @click="logout" block>Logout <span class="fa fa-lock"></span></b-btn>
        </div>
    </sidebar-menu>
</template>

<script>
export default {
    data() {
        return {
            menu: [
                {
                    href: {name:'Home'},
                    title: 'Dashboard',
                    icon: 'fas fa-chart-line'
                },
                {
                    href: null,
                    title: 'Master',
                    child: [
                        {
                            href: '/app/slider',
                            title: 'Slider'
                        }
                    ]
                }
            ]
        }
    }
}
</script>
