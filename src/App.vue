<template>
    <div id="app">
        <apple-loading></apple-loading>
        <router-view/>
    </div>
</template>
<script>
    import AppleLoading from "./components/apple-loading/Apple-loading";
    export default {
        name: "App",
        components: {
            AppleLoading
        }
    }
</script>

<style lang="scss">
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
    }
</style>
