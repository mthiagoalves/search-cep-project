<template>
    <footer class="footer">
        <div class="content has-text-centered">
            <p>
                {{ footerText }}
            </p>
        </div>
    </footer>
</template>

<script>
export default {
    props: {
        footerText: String,
    },
};
</script>

<style scoped>
.footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #f4f4f4;
    padding: 1rem;
    text-align: center;
}
</style>
