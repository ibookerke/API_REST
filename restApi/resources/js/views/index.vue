<template>
    <div>
        <div class="tableHeading">
            <h4 style="width: 10%;">id</h4>
            <h4 style="width: 40%;">Country Name</h4>
            <h4 style="width: 40%;">Country Name(en)</h4>
            <h4 style="width: 10%;">Alias</h4>
        </div>
        <div id="tableBody">

        </div>
        <div id="pagination" style="padding-top: 20px;">
            <nav>
                <ul class="d-flex justify-content-between pagination">
                    <li style="min-width: 45px; text-align: center;" v-for="page in pages" v-on:click="openPage(page)" v-bind:id="page" class='page-item'>
                        <a class='page-link'  href='#'>{{page}}</a>
                    </li>
                </ul>
            </nav>
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
                pages: null
            }
        },
        mounted() {
            getTableData(1)
            getPageNum()
                .then(response => {
                    this.pages = response["pageNum"]
                })
                .catch(err => console.log(err))
        },
        methods: {
            openPage(page) {
                getTableData(page)
            }
        }
    }

    function getTableData(page = 1) {
        axios.get("http://127.0.0.1:8000/api/country/page/" + page, axConfig)
            .then(response => {
                renderTable(response.data)
            })
    }

    async function getPageNum() {
        const promise = axios.get("http://127.0.0.1:8000/api/country/getPageNum", axConfig)
        const dataPromise = promise.then((response) => response.data)
        return dataPromise
    }

    function renderTable(data) {
        let html = ""

        for(const row in data){
            let country = data[row]
            html += "<div class=\"d-flex justify-content-between data-row\">" +
                        "<p style=\"width: 10%;\">" + country.id + "</p>\n" +
                        "<p style=\"width: 40%;\">" + country.name + "</p>\n" +
                        "<p style=\"width: 40%;\">" + country.name_en + "</p>\n" +
                        "<p style=\"width: 10%;\">" + country.alias.toUpperCase() + "</p>" +
                    "</div>"
        }
        let body = document.getElementById("tableBody")
        body.innerHTML = html
    }


</script>

<style scoped>

</style>
