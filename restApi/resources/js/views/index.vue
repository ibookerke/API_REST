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
            <p style="width: 10%">{{row.alias}}</p>
        </div>

    </div>
</template>

<script>

function renderTable(data) {

}

import axios from "axios"
const axConfig = {
    headers: {

    }
}
export default {
    name: "index",
    data () {
        return {
            data: null
        }
    },
    created() {

    },
    mounted() {
        let token = localStorage.getItem("jwt")
        let config = {
            headers: {
                Authorization: "Bearer" + token
            }
        }

        axios.get("http://127.0.0.1:8000/api/country/page/" + 1, config)
            .then(response => (this.data = response.data))
    }
}
</script>

<style scoped>

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
