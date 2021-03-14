<template>
    <div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Country Id</span>
            </div>
            <input type="text" class="form-control" id="idInput" placeholder="id" aria-label="id" aria-describedby="basic-addon1">
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-info" id="btnSearch" v-on:click="searchById">Search</button>
<!--                <span style="cursor: pointer;" class="input-group-text"  v-on:click="searchById">Search</span>-->
            </div>
        </div>
        <div id="searchBody">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">id</span>
                </div>
                <input type="text" class="form-control" disabled placeholder="id" id="searchId" aria-label="id" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input type="text" class="form-control" disabled placeholder="Country Name" id="searchName" aria-label="Country Name" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name_en</span>
                </div>
                <input type="text" class="form-control" disabled placeholder="Name in English" id="searchEn" aria-label="Name in English" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">alias</span>
                </div>
                <input type="text" class="form-control" disabled placeholder="Alias" id="searchAlias" aria-label="alias" aria-describedby="basic-addon1">
            </div>
        </div>

        <div>
            <button type="button" class="btn btn-success" v-on:click="saveChanges">Save Changes</button>
            <button type="button" class="btn btn-danger" v-on:click="deleteRecord">Delete Record</button>
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
    name: "edit",
    data () {
        return {
            data: null
        }
    },
    methods: {
        searchById : function (event){
            event.preventDefault()

            let id = document.getElementById("idInput").value;

            axios.get("http://127.0.0.1:8000/api/country/" + id, axConfig)
                .then(response => {
                    renderSearch(response.data)
                })
                .catch(error => {
                    alert("There is no country with the inserted id")
                })
        },
        saveChanges : function (event){
            event.preventDefault()
            let id =  document.getElementById("searchId").value
            let name =  document.getElementById("searchName").value
            let name_en =  document.getElementById("searchEn").value
            let alias =  document.getElementById("searchAlias").value
            let request = {
                "alias" : alias,
                "name_en" : name_en,
                "name" : name
            }

            axios.put("http://127.0.0.1:8000/api/country/" + id, request, axConfig)
                .then(response => {
                    alert("Data have been successfully changed")
                })
                .catch(error => {
                    alert("The inserted values have not passed the validation")
                })

        },
        deleteRecord : function (event){
            event.preventDefault()
        }

    },
    mounted() {
        let input = document.getElementById("idInput");
        input.addEventListener("keyup", function(event) {
            // Number 13 is the "Enter" key on the keyboard
            if (event.keyCode === 13) {
                // Cancel the default action, if needed
                event.preventDefault();
                // Trigger the button element with a click
                document.getElementById("btnSearch").click();
            }
        });
    }
}
function renderSearch(data) {
    let id =  document.getElementById("searchId")
    let name =  document.getElementById("searchName")
    let name_en =  document.getElementById("searchEn")
    let alias =  document.getElementById("searchAlias")

    id.value = data.id
    name.value = data.name
    name.disabled = false;
    name_en.value = data.name_en
    name_en.disabled = false;
    alias.value = data.alias.toUpperCase()
    alias.disabled = false;
}

</script>

<style scoped>
    input:focus{
        box-shadow: none;
    }
    label{
        font-size: 30px;
        font-weight: 900;
    }
    button:focus{
        box-shadow: none;
    }
</style>
