<template>
    <div>
        <h3>这是demo2</h3>
        {{$store.state.name}}
        <hr>
        {{$store.getters.reverseNames}}
        <hr>
        {{$store.getters.filterSkill}}
        <hr>
        {{names}}
        <hr>
        {{sex1}}
        <hr>
        {{skills}}
        <hr>
        {{arrs}}
    </div>
</template>

<script>
    import {mapState} from "vuex";

    export default {
        name: "demo2",
        data() {
            return {
                arr: ['react', 'webpack', 'Nodejs']
            }
        },
        computed: {
            names() {
                return this.$store.state.name;
            },
            ...mapState({
                sex1: 'sex',   //传字符串参数，起别名
                skills: state => state.skill,
            }),
            ...mapState({
                arrs(state) {
                    return this.arr.concat(...state.skill);
                }
            })
        }
    }
</script>

<style scoped>
    button {
        width: 100%;
        height: 0.8rem;
        font-size: 0.8rem;
    }
</style>