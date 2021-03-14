<template>
    <div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Name</span>
            </div>
            <input type="text" class="form-control searchInput" placeholder="Country Name" id="searchName" aria-label="Country Name" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Name_en</span>
            </div>
            <input type="text" class="form-control searchInput" placeholder="Name in English" id="searchEn" aria-label="Name in English" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text searchInput">Alias</span>
            </div>
            <input type="text" class="form-control searchInput" placeholder="Alias" id="searchAlias" aria-label="alias" aria-describedby="basic-addon1">
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-success" v-on:click="saveRecord">Save</button>
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
    name: "add",
    data () {
        return {
            data: null
        }
    },
    methods: {
        saveRecord: function() {
            let name =  document.getElementById("searchName").value
            let name_en =  document.getElementById("searchEn").value
            let alias =  document.getElementById("searchAlias").value
            let request = {
                "alias" : alias,
                "name_en" : name_en,
                "name" : name
            }
            axios.post("http://127.0.0.1:8000/api/country/", request, axConfig)
                .then(response => {
                    alert("Record have been successfully added")
                    name.value = ""
                    name_en.value = ""
                    alias.value = ""
                })
                .catch(error => {
                    alert("Unacceptable values were inserted")
                })
        }
    }
}
</script>

<style scoped>

</style>
