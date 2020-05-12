<template>
    <div>
        <h1 ref="test">Hooks ...</h1>
    </div>
</template>
<script>
export default {
    data(){
        return{

        }
    },
    created(){
        
        
    },
    mounted(){
        console.log(this.$refs.test);
    }
}
</script>