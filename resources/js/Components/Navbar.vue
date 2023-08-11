<template>
    <nav class="navbar mb-5">
        <div class="navbar-brand">
            <p class="navbar-item" href="#">
                {{ appName }}
            </p>
        </div>
    </nav>
</template>

<script>
export default {
    props: {
        appName: String,
    },
};
</script>

<style scoped>
.navbar {
    background-color: #333;
    color: #fff;
    padding: 1rem;

}
.navbar-item{
    color: #fff;
}
</style>
