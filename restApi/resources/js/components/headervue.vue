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
                    title: "Search by id",
                    href: "/edit"
                }
            ]
        }
    }

}
</script>

<style>
.header-nav{
    display: flex;
    justify-content: space-around;
}
.header-li{
    list-style-type: none;
}
.tableHeading{
    height: 50px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #ababab;
    text-align: center;
}
.tableHeading h4{
    box-sizing: border-box;
    margin-bottom: 0;
}

.data-row{
    align-items: center;
}
.data-row:hover{
    background: #d4d4d4;
}
.data-row p{
    text-align: center;
    height: 35px;
    margin-bottom: 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: center;
    align-items: center;
}

</style>
