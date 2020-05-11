<template>
    <div class="section m-4">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item , key) in items" :key="key">
                <td>
                    <strong v-text="item.name"></strong>
                    <p v-text="item.description"></p>
                </td>
                <td><span v-text="item.price"></span></td>
            </tr>
            </tbody>

        </table>
    </div>
</template>
<script>
    export default {
        props:['items']
    }
</script>
