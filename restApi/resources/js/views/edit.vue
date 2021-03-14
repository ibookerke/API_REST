<template>
    <div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Country Id</span>
            </div>
            <input type="text" class="form-control" id="idInput" placeholder="id" aria-label="id" aria-describedby="basic-addon1">
            <div class="input-group-append">
                <span style="cursor: pointer;" class="input-group-text" id="basic-addon2" v-on:click="searchById">Search</span>
            </div>
        </div>
        <div id="searchBody">

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
            let id = document.getElementById("idInput").value;

            axios.get("http://127.0.0.1:8000/api/country/" + id, axConfig)
                .then(response => {
                    renderSearch(response.data)
                })
                .catch(error => {
                    alert("There is no country with the inserted id")
                })
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
                document.getElementById("basic-addon2").click();
            }
        });
    }
}
function renderSearch(data) {
    let html = "<div class=\"input-group mb-3\">\n" +
        "  <div class=\"input-group-prepend\">\n" +
        "    <span class=\"input-group-text\" id=\"inputGroup-sizing-default\">id</span>\n" +
        "  </div>\n" +
        "  <input type=\"text\" value='" + data.id + "' class=\"form-control\" aria-label=\"Default\" aria-describedby=\"inputGroup-sizing-default\">\n" +
        "</div>"
    html += "<div class=\"input-group mb-3\">\n" +
        "  <div class=\"input-group-prepend\">\n" +
        "    <span class=\"input-group-text\" id=\"inputGroup-sizing-default\">Name</span>\n" +
        "  </div>\n" +
        "  <input type=\"text\" value='" + data.name + "' class=\"form-control\" aria-label=\"Default\" aria-describedby=\"inputGroup-sizing-default\">\n" +
        "</div>"
    html += "<div class=\"input-group mb-3\">\n" +
        "  <div class=\"input-group-prepend\">\n" +
        "    <span class=\"input-group-text\" id=\"inputGroup-sizing-default\">Name_en</span>\n" +
        "  </div>\n" +
        "  <input type=\"text\" value='" + data.name_en + "' class=\"form-control\" aria-label=\"Default\" aria-describedby=\"inputGroup-sizing-default\">\n" +
        "</div>"
    html += "<div class=\"input-group mb-3\">\n" +
        "  <div class=\"input-group-prepend\">\n" +
        "    <span class=\"input-group-text\" id=\"inputGroup-sizing-default\">Alias</span>\n" +
        "  </div>\n" +
        "  <input type=\"text\" value='" + data.alias.toUpperCase() + "' class=\"form-control\" aria-label=\"Default\" aria-describedby=\"inputGroup-sizing-default\">\n" +
        "</div>"

    let body = document.getElementById("searchBody")
    body.innerHTML = html;
}


</script>

<style scoped>
    label{
        font-size: 30px;
        font-weight: 900;
    }
</style>
