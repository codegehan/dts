<style>
.loader{
    position: fixed;
    top: 0;
    lefT: 0;
    width: 100vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f7f9fb;
    transition: opacity 0.75, visibility 0.75;
}
.loader-hide{
    content: "";
    visibility: hidden;
}
.loader::after{
    content: "";
    width: 60px;
    height: 60px;
    border: 10px solid #dddddd;
    border-top-color: #dc3545;
    border-radius: 50%;
    animation: loading 0.75s ease infinite;
}
@keyframes loading{
    from{
        transform: rotate(0turn);
    }
    to{
        transform: rotate(1turn);
    }
}
</style>

<div class="loader"></div>
<script>
    window.addEventListener("load", () => {
        const loader = document.querySelector(".loader");
        loader.classList.add("loader-hide");

        loader.addEventListener("transitionend", () => {
            document.body.removeChild("loader");
        })
    })
</script>