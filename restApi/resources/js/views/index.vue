<template>
    <div>
        <h1>home page!</h1>
    </div>
</template>

<script>
import axios from "axios"
const axConfig = {
    headers: {
        Authorization: "Bearer " +
    }
}
export default {
    name: "index",
    created() {

    },
    mounted() {
        axios.get("http://127.0.0.1:8000/api/country")
            .then(response => console.log(response))
    }
}
</script>

<style scoped>

</style>
