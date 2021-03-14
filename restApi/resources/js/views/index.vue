<template>
    <div>
        <div class="tableHeading">
            <h4 style="width: 10%;">id</h4>
            <h4 style="width: 40%;">Country Name</h4>
            <h4 style="width: 40%;">Country Name(en)</h4>
            <h4 style="width: 10%;">Alias</h4>
        </div>
        <div v-for="row in data" class="d-flex justify-content-between data-row" >
            <p style="width: 10%;">{{row.id}}</p>
            <p style="width: 40%;">{{row.name}}</p>
            <p style="width: 40%;">{{row.name_en}}</p>
            <p style="width: 10%">{{row.alias.toUpperCase()}}</p>
        </div>

    </div>
</template>

<script>

import axios from "axios"
let token = localStorage.getItem("jwt")
const axConfig = {
    headers: {
        Authorization: "Bearer" + token
    }
}
export default {
    name: "index",
    data () {
        return {
            data: null
        }
    },
    mounted() {
        axios.get("http://127.0.0.1:8000/api/country/page/" + 1, axConfig)
            .then(response => (this.data = response.data))
    }
}
</script>

<style scoped>

</style>
