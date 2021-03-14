<template>
    <div>
        <ul class="header-nav">
            <li v-for="link in links" class="header-li">
                <router-link class="navbar-brand" :to="link.href">{{link.title}}</router-link>
            </li>
        </ul>

    </div>
</template>

<script>


export default {
    name: "headervue",

    data() {
        return {
            links: [
                {
                    title: "Main",
                    href: "/"
                },
                {
                    title: "Edit",
                    href: "/edit"
                }
            ]
        }
    }

}
</script>

<style scoped>
.header-nav{
    display: flex;
    justify-content: space-around;
}
.header-li{
    list-style-type: none;
}

</style>
