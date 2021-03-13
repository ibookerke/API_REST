<template>
    <div>
        <h1>home page!</h1>
    </div>
</template>

<script>
export function authHeader() {
    // return authorization header with jwt token
    let user = JSON.parse(localStorage.getItem('user'));

    if (user && user.token) {
        return { 'Authorization': 'Bearer ' + user.token };
    } else {
        return {};
    }
}

import axios from "axios"
const axConfig = {
    headers: {

    }
}
export default {
    name: "index",
    created() {

    },
    mounted() {
        let token = authHeader()
        console.log(token)
        axios.get("http://127.0.0.1:8000/api/country")
            .then(response => console.log(response))
    }
}
</script>

<style scoped>

</style>
