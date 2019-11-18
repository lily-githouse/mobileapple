<template>
    <!--    各个组件都需要loading,--放到vuex中-->
    <div>
        <div class="loading" v-show="isShow">
            <div class="loading-box">
                <div class="loading-box-circle"></div>
            </div>
            <div class="loading-box">
                <div class="loading-box-circle"></div>
            </div>
            <div class="loading-box">
                <div class="loading-box-circle"></div>
            </div>
            <div class="loading-box">
                <div class="loading-box-circle"></div>
            </div>
            <div class="loading-box">
                <div class="loading-box-circle"></div>
            </div>
            <div class="loading-box">
                <div class="loading-box-circle"></div>
            </div>
            <div class="loading-box">
                <div class="loading-box-circle"></div>
            </div>
            <div class="loading-box">
                <div class="loading-box-circle"></div>
            </div>
            <div class="loading-box">
                <div class="loading-box-circle"></div>
            </div>
            <div class="loading-box">
                <div class="loading-box-circle"></div>
            </div>
            <div class="loading-box">
                <div class="loading-box-circle"></div>
            </div>
            <div class="loading-box">
                <div class="loading-box-circle"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Apple-loading",
        computed: {
            isShow() {
                return this.$store.state.isShow;
            }
        }
    }
</script>

<style scoped lang="scss">
    $color: orange;
    $deg: 360/12;
    $width: 100%;
    $height: 100%;

    .loading {
        position: fixed;
        z-index: 999;
        background-color: rgb(0, 0, 0, 0.3);
        width: $width;
        height: $height;

        > .loading-box {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            width: 2rem;
            height: 1rem;

            > .loading-box-circle {
                position: absolute;
                left: 0;
                right: 0;
                width: 0.2rem;
                height: 0.2rem;
                border-radius: 50%;
                background-color: $color;
                animation: toggle 1s infinite ease;
            }
        }
    }

    @for $i from 1 through 12 {
        .loading > .loading-box:nth-child(#{$i}) {
            transform: rotateZ(#{$i*$deg}deg);

            .loading-box-circle {
                animation-delay: $i*83ms;
            }
        }
    }

    @keyframes toggle {
        from {
            opacity: 0;
            transform: scale(0, 0);
        }
        to {
            opacity: 1;
            transform: scale(1, 1);
        }
    }
</style>